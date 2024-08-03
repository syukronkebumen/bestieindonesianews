<?php
namespace app\models\admin;

use Dee;

class Profile
 {
	public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
        
	public function getview(){
	   
		$id = isset(Dee::$app->user->id) ? Dee::$app->user->id : NULL;
        $sql = "SELECT * FROM `users` AS `u`  WHERE `u`.`id`='".$id."'";
		return \Dee::$app->db->queryOne($sql);
	}
    public function update(){
		$response['status']		= "error";
		$response['message']	= "Please check your input";
        
		if(isset($_POST["pk"])){
			$setting_id 	= $_POST["pk"];
            $colums 	    =  $_POST["name"];
			if($setting_id ){
				$data[$colums] 	= preg_replace('~[\r\n\t]+~', '', $_POST["value"]);
			} else {
				$data[$colums] = $_POST["value"];
			}
		   $updated = \Dee::$app->db->update('users', $data, ['id' => $setting_id]);
           
			if(isset($updated)){
				$response['status'] = "success";
				$response['message'] = "Data has been save";
				$response['redirect'] = "settings";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data couldn't save";
			}
		}
		return $response;
	}
    
    public function upload(){
            $file = isset($_FILES['file']) ? $file = $_FILES['file'] : array();
			$id      = isset(Dee::$app->user->id) ? Dee::$app->user->id : NULL;
			if(	isset($file['tmp_name']) && !empty($file['tmp_name']) ){
				
                $img = $this->uploader(200,200,$file);
              	$data['image'] 			= $img;
			    
				if(isset($img) && !empty($img)){
					\Dee::$app->db->update("users",$data, ['id' => $id] );
                    $response['status'] = "success";
					$response['message'] = "Image berhasil di upload";
                    $response['redirect'] = "admin/profile";
				} else {
					$response['status'] = "error";
					$response['message'] ="Image gagal di upload";
				}
			} else {
				$response['status'] = "error";
				$response['message'] ="Tidak ada image yang di upload";
			}
            return $response;
		}
    
     public function uploadered()
   {
        $uploader = new \app\models\admin\Uploader();
     	$uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx'));  
        $uploader->setMaxSize(5);                          
        $uploader->setDir(Dee::$app->basePathe.'/uploads/administrator/');
        //$uploader->getThumb(200);
        $uploader->reSize(200,200); 
            if($uploader->uploadFile('file'))          
                {$data  =   $uploader->getUploadName();}
        return $data;
    }	
    public function uploader($x,$y,$file)
    {
                    $upload = new \app\models\admin\GTupload();
					$upload->folder(Dee::$app->basePathe.'/uploads/administrator/')
						->source($file)->size($x,$y)->upload();
       				$photo = $upload->result;
					if(isset($photo['status']) && $photo['status'] == TRUE){
						$data = $photo['basename'];
					}
                    return $data;
     }	
     
    
	public function updatepw(){
       $hash = new \app\models\admin\PasswordHash(8, TRUE);
	   $data = $_POST['edit'];
		$response['status'] = "error";
		$response['message'] = "Please check your input";
		if(isset($data)){
		  if( $_SESSION['captcha']['code'] == $_POST['captcha']){
			     $id      = isset(Dee::$app->user->id) ? Dee::$app->user->id : NULL;
			     $sql		= "SELECT `id` FROM `users` WHERE `id`='". $id ."'";
                 $oldpw		= \Dee::$app->db->queryOne($sql);
            
			if( count(\Dee::$app->db->queryAll($sql)) > 0 ){
				if ($id <> null && !empty($id)) {
					if($data['passwordbaru'] == $data['passwordulang']){
						$ins['password'] = $hash->HashPassword( trim( $data['passwordulang'] ) );
                   		$updated = \Dee::$app->db->update("users",$ins, ['id' => $id] );
                  		if(isset($updated) && !empty($updated) && $updated == TRUE){
							$response['status'] = "success";
							$response['message'] = "Password Anda Berhasil Diubah";
							$response['redirect'] = "admin/profile";
						} else {
							$response['message'] = "Password Anda Gagal Diubah";
						}
					}else{
						$response['message'] = "Password tidak sama";
					}
				} else {
				    $response['message'] = "Tidak Diizinkan";
				}
			} else {
				$response['message'] = "Belum Terdaftar";
			}
            } else {
				$response['message'] = "Kode captcha tidak sama";
			}
		}
		return $response;
	}
    
    public function password($text){
		$timeTarget = 0.05;
		$cost = 8;
		$pass;
		do {
		    $cost++;
		    $start = microtime(true);
		    $pass = password_hash($text, PASSWORD_BCRYPT, ["cost" => $cost]);
		    $end = microtime(true);
		} while (($end - $start) < $timeTarget);

		return $pass;
	}
}