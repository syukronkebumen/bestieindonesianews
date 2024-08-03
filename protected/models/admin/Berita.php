<?php
namespace app\models\admin;

use Dee;

class Berita
 {
    
    
    public function getAll(){
        
       $query	= "
			SELECT `art`.*, `v`.`isi` AS `isi`
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category` 
			WHERE `art`.`niw`='".Dee::$app->niw."' AND `art`.`category` != 3
            ORDER BY `art`.`id` DESC 
		";
		return \Dee::$app->db->queryAll($query);
	}
   public function getAllKinerja(){
        
       $query	= "
			SELECT `art`.*, `v`.`isi` AS `isi`
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category` 
			WHERE `art`.`niw`='".Dee::$app->niw."' AND `art`.`category` = 3
            ORDER BY `art`.`id` DESC 
		";
		return \Dee::$app->db->queryAll($query);
	}
    
	public function simpan(){
	   
		$data = $_POST['artikel'];
		$response['status'] = "error";
		$response['message'] = "Please check your input";
        
		if(isset($data)){
			     
                $admin_id		= $data['id'];
		    	$file = isset($_FILES['file']) ? $file = $_FILES['file'] : array();
                
				if(	isset($file['tmp_name']) && !empty($file['tmp_name']) ){
			  	    $img = $this->uploader($file);
					$data['img_header'] = $img;
					}
                    $data['slug'] = $this->slug($data['title']);
                
                if( isset($admin_id) && !empty($admin_id) ){
                     if(isset($file['tmp_name']) && !empty($file['tmp_name']) ){
                    $oldphoto = \Dee::$app->db->queryOne("SELECT `img_header` FROM `artikel` WHERE `id`='". $admin_id ."'");
               		if(is_file(Dee::$app->basePathe.'/uploads/artikel/' . $oldphoto['img_header'])){
						unlink(Dee::$app->basePathe.'/uploads/artikel/' . $oldphoto['img_header']);
                        unlink(Dee::$app->basePathe.'/uploads/artikel/thumb/' . $oldphoto['img_header']);
					}
                    }
                    $simpan = \Dee::$app->db->update('artikel', $data , ['id' => $admin_id]);
                }else{
					$aku['data_id']     = '0';
					$aku['title']       = $data['title'];
					$aku['slug']        = $data['slug'];
					$aku['date']        = date('Y-m-d');
					$aku['time']        = date('H:i:s');
					$aku['author']      = Dee::$app->user->id;
					$aku['img_header']  = $data['img_header'];
					$aku['content']     = $data['content'];
					$aku['category']    = $data['category'];
					$aku['status']      = '0';
					$aku['views']       = '223';
					$aku['niw']         = Dee::$app->niw;
					$aku['caption'] 	= $data['caption'];
                    $simpan = \Dee::$app->db->insert('artikel', $aku);
                }
                $rd = $data['category'] != 3 ? 'berita' :'kinerja';
                
				if(isset($simpan) && $simpan == TRUE){
					$response['status'] = "success";
					$response['message'] = "Data has been save";
					$response['redirect'] = Dee::createUrl('admin/'.$rd);
				} else {
					$response['message'] = "Data couldn't save";
			}
		}
		return $response;
	}
  
	public function delete(){
		$id = $_POST['id'];
		$response['status'] = "error";
		$response['message'] = "Please check your selected data";
		if(isset($id)){
			$updated = \Dee::$app->db->delete('artikel', ['id' => $id]);			
			
			if(isset($updated) && $updated == TRUE){
				$response['status'] = "success";
				$response['message'] = "Data Sudah dihapus !!";
				$response['redirect'] = "";
			} else {
				$response['message'] = "Data couldn't Not Active";
			}
		}
		return $response; 
	}

    public function uploader($file)
   {
        $uploader = new \app\models\admin\Uploader();
     	$uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx'));  
        $uploader->setMaxSize(5);                          
        $uploader->setDir(Dee::$app->basePathe.'/uploads/artikel/');
        $uploader->getThumb(200,0);
        $uploader->reSize(750,0); 
            if($uploader->uploadFile('file'))          
                {$data  =   $uploader->getUploadName();}
        return $data;
    }	
    
     public function uploaderd($file)
    {
                    $upload = new \app\models\admin\GTupload();
					$upload->folder(Dee::$app->basePathe.'/uploads/artikel/')
						->source($file)->size(750,350)
						->rename_to(time())
                        ->thumb(250)
						->upload();
       				$photo = $upload->result;
					if(isset($photo['status']) && $photo['status'] == TRUE){
						$data = $photo['basename'];
					}
                    return $data;
     }	
     
    public function slug($text){
		$first	= str_replace(array('"',"'"),'',$text);
		$second = preg_replace('/[^a-zA-Z0-9\s\-]/mi','',urldecode($first));
		$third 	= preg_replace('!\s+!','-',$second);
		$result = preg_replace('!-+!','-',$third);
		return strtolower($result);
	}
}