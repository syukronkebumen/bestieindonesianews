<?php 
namespace app\models\admin;

use Dee;

class Dokumen
 {
   public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
   
   public function lists($cat = null){
	   
		$pagination = new \app\models\Pagination();
        if(isset($_GET['hal'])){
            $segment2 = $_GET['hal'];
        }
		//$segment2 = $this->route->segment(2);
		$page = isset($segment2) && !empty($segment2) ? (int)$segment2 : 1;
	    $sql	= "
			SELECT `g`.*, `v`.`isi` AS `isi`
			FROM `galery` AS `g`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`g`.`id_album` 
			WHERE `g`.`kategori` = '".$cat."'
            ORDER BY `g`.`id` DESC 
		";
        
        $query = \Dee::$app->db->queryAll($sql);
		
		$pagination->total = count($query);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 12;
		$pagination->url =  Dee::createUrl('admin/slide?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($sql . $limit);
        
		$data = array();
		foreach($dataa AS $item){
			
			$item['title'] = $item['title_img'];
			$data[] = $item;
		}
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
		return $result;
	}
    public function listswarga($cat = null){
	   
		$pagination = new \app\models\Pagination();
        if(isset($_GET['hal'])){
            $segment2 = $_GET['hal'];
        }
		//$segment2 = $this->route->segment(2);
		$page = isset($segment2) && !empty($segment2) ? (int)$segment2 : 1;
	
        $sql	= "
		SELECT `f`.*
		FROM `galery` AS `f`
		WHERE `f`.`kategori`='".$cat."' AND `f`.`status`='0' 
		ORDER BY  `f`.`id_album` ASC
		";
        $query = \Dee::$app->db->queryAll($sql);
		
		$pagination->total = count($query);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 10;
		$pagination->url =  Dee::createUrl('panel/sdm?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($sql . $limit);
        
		$data = array();
		foreach($dataa AS $item){
			
			$item['title'] = $item['title_img'];
			$data[] = $item;
		}
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
		return $result;
	}
	public function getOne(){
		$id = $_POST['id'];
		if(isset($id)){
		    $query    =  "SELECT * FROM `galery` WHERE `id`='". $id ."'";
			$data =   \Dee::$app->db->queryOne($query);
            $image = $data['image_url'];
            $photo = isset($image) && is_file(Dee::$app->basePathe. '/uploads/slide/' . $image) ?  Dee::$app->baseUrl. '/public/uploads/slide/' . $image : Dee::$app->baseUrl. "/assets/images/no-image/poster.jpg";
            $data['img'] = $photo;
          }
		return $data; 
	}
    public function youtube($url)
          {
            $link = str_replace('https://www.youtube.com/watch?v=', '', $url);
            return $link;
          }
          
    public function getYtb(){
		$id = $_POST['id'];
		if(isset($id)){
		    $query    =  "SELECT * FROM `galery` WHERE  `id`='". $id ."'";
			$data =   \Dee::$app->db->queryOne($query);
            $image = $this->youtube($data['description']);
            $photo = 'https://img.youtube.com/vi/'.$image.'/hqdefault.jpg';
      	    $data['img'] = $photo;
          }
		return $data; 
	}
    public function getKepsek(){
	
		    $query    =  "SELECT * FROM `galery` WHERE  `id_album`='1'";
			$data =   \Dee::$app->db->queryOne($query);
            $image = $data['image_url'];
            $photo = isset($image) && is_file(Dee::$app->basePathe. '/uploads/warga/' . $image) ?  Dee::$app->baseUrl. '/public/uploads/warga/' . $image : Dee::$app->baseUrl. "/assets/images/no-image/poster.jpg";
      	    $data['img'] = $photo;
          
		return $data; 
	}
	public function delete(){
		$id = $_POST['id'];
		$response['status'] = "error";
		$response['message'] = "Please check your selected data";
		if(isset($id)){
		    $query    =  "SELECT `image_url` FROM `galery` WHERE `id`='". $id ."'";
			$oldphoto =   \Dee::$app->db->queryOne($query);
            
			$delete = \Dee::$app->db->delete("galery",["`id` " => $id ] );
			if(isset($delete) && $delete == TRUE){
				if(is_file(Dee::$app->basePathe.'/uploads/slide/' . $oldphoto['image_url'])){
					unlink(Dee::$app->basePathe.'/uploads/slide/' . $oldphoto['image_url']);
                    unlink(Dee::$app->basePathe.'/uploads/slide/thumb/' . $oldphoto['image_url']);
				}
				$response['status'] = "success";
				$response['message'] = "Data has been deleted";
				$response['redirect'] = "";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data couldn't deleted";
			}
		}
		return $response; 
	}
	public function delete_multiple(){
		$id = $_POST['id'];
		$response['status'] = "error";
		$response['message'] = "Please check your selected data";
		if(isset($id)){
		
			foreach($id AS $val){
				$deleted_id[] = $val ;
			}
            $query    =  "SELECT `image_url` FROM `galery` WHERE `id` IN ('". (implode("','",$deleted_id)) ."')";
			$oldphoto =  \Dee::$app->db->queryAll($query);
            
			$delete = \Dee::$app->db->delete("galery","`id` IN ('". (implode("','",$deleted_id)) ."')");
			if(isset($delete)){
				foreach($oldphoto AS $val){
					if(is_file(Dee::$app->basePathe.'/uploads/slide/' .  $val['image_url'])){
						unlink(Dee::$app->basePathe.'/uploads/slide/' .  $val['image_url']);
                        unlink(Dee::$app->basePathe.'/uploads/slide/thumb' . $val['image_url']);
					}
				}
				$response['status'] = "success";
				$response['message'] = "Data has been deleted";
				$response['redirect'] = "admin/slide";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data couldn't deleted";
			}
		}
		return $response;
	}
    public function simpan(){
               $response['status']		= "error";
		       $response['message']	= "Please check your input";
               
               if(isset($_POST["edit"])){
               $data = $_POST["edit"];
               
               
                                
			   $file = isset($_FILES['file']) ? $file = $_FILES['file'] : array();
     		  if(isset($file['tmp_name']) && !empty($file['tmp_name']) ){
			 
			     $name = $file["name"];
			     move_uploaded_file($file['tmp_name'], Dee::$app->basePathe.'/uploads/dokumen/' . $name);
                 $data['image_url'] 		= $name;
                 $aku['image_url'] 		= $name;
			 
			   } 
            
                               
                if($data['id'] > 1) {
                    $simpan = \Dee::$app->db->update("galery",$data,['id' => $data['id']]);
                 }else{
                     $aku['id_album'] = $data['id_album']; 
                     $aku['title_img'] = $data['title_img'];
                     $aku['image_url'] = $data['image_url'];
                     $aku['description'] = $data['description'];
                     $aku['kategori'] = $data['kategori'];
                     $aku['status'] = $data['status'];
                     $aku['niw'] 		    = $this->niw;
                     $simpan = \Dee::$app->db->insert("galery",$aku);
                }
				if($simpan){
			        $response['status'] = "success";
					$response['message'] = "Image berhasil di upload";
                    $response['redirect'] = "";
				} else {
					$response['status'] = "error";
					$response['message'] ="Image gagal di upload";
				}
                }
            return $response;
		}
        
    public function upload(){
            $file = isset($_FILES['file']) ? $file = $_FILES['file'] : array();
			
			if(	isset($file['tmp_name']) && !empty($file['tmp_name']) ){
				$filename = pathinfo($file["name"], PATHINFO_FILENAME);
                
                $img = $this->uploader(960,540,$file);
                                
                $data['title_img'] 			= $filename;
				$data['image_url'] 			= $img;
				$data['kategori'] 		= '1';
				$data['status'] 		= '0';
                $data['niw'] 		   = $this->niw;
				if(isset($img) && !empty($img)){
				    
					\Dee::$app->db->insert("galery",$data);
                    
                    $response['status'] = "success";
					$response['message'] = "Image berhasil di upload";
                    $response['redirect'] = "admin/slide";
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
        
     public function simpanWarga(){
               $data = $_POST['edit'];
			   $file = isset($_FILES['file']) ? $file = $_FILES['file'] : array();
                
			if(	isset($data['image_url']) && !empty($data['image_url']) ){
		        $img = $data['image_url'];
                $data['image_url'] 		= $img;
			   } 
                               
                if($data['id'] > 1) {
                    $simpan = \Dee::$app->db->update("galery",$data,['id' => $data['id']]);
                 }else{
                     $aku['id_album'] = $data['id_album']; 
                     $aku['title_img'] = $data['title_img'];
                     $aku['image_url'] = $data['image_url'];
                     $aku['description'] = $data['description'];
                     $aku['kategori'] = $data['kategori'];
                     $aku['status'] = $data['status'];
                     $aku['niw'] 		    = $this->niw;
                     $simpan = \Dee::$app->db->insert("galery",$aku);
                }
				if($simpan){
			        $response['status'] = "success";
					$response['message'] = "Image berhasil di upload";
                    $response['redirect'] = "";
				} else {
					$response['status'] = "error";
					$response['message'] ="Image gagal di upload";
				}
            return $response;
		}   
     public function uploadWarga(){
		
		if(isset($_POST["image"])){
 	      $data = $_POST["image"];
	       $image_array_1 = explode(";", $data);
	       $image_array_2 = explode(",", $image_array_1[1]);
	       $data = base64_decode($image_array_2[1]);
	       $imageName = time() . '.jpg';
	       file_put_contents(Dee::$app->basePathe.'/uploads/warga/'.$imageName, $data);
           
           return $imageName;
          
                }
            }
	
       
     public function uploader($x,$y)
   {
        $uploader = new \app\models\admin\Uploader();
     	$uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx'));  
        $uploader->setMaxSize(5);                          
        $uploader->setDir(Dee::$app->basePathe.'/uploads/slide/');
        $uploader->getThumb(200);
        $uploader->reSize($x,$y); 
            if($uploader->uploadFile('file'))          
                {$data  =   $uploader->getUploadName();}
        return $data;
    }
    
    public function uploaderdd($x,$y,$file)
    {
                   
                    $upload = new \app\models\admin\GTupload();
					$upload->folder(Dee::$app->basePathe.'/uploads/slide/')
						->source($file)->size($x,$y)
						->rename_to(time())
                        ->thumb(350)
						->upload();
       				$photo = $upload->result;
					if(isset($photo['status']) && $photo['status'] == TRUE){
						$data = $photo['basename'];
					}
                    return $data;
     }	
}