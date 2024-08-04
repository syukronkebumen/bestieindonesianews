<?php
namespace app\models\admin;

use Dee;

class Pages
 {
    
    public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
        
    public function getAll(){
	
		$query 		= "SELECT * FROM `nilai` WHERE `thekey`='menu' AND `niw`='".Dee::$app->niw."' ORDER BY value_id DESC";
		return \Dee::$app->db->queryAll($query);
	}
   public function getPage(){
		
        $menu_id = $_GET['parent'];
		$query 		= "SELECT * FROM `pages` WHERE `parent`='".$menu_id."' AND `niw`='".Dee::$app->niw."' ORDER BY pages_id DESC";
		return \Dee::$app->db->queryAll($query);
	}

	
    public function updateVal(){
		$response['status']		= "error";
		$response['message']	= "Please check your input";
        
		if(isset($_POST)){
			$setting_id 	= (int)$_POST["pk"];
            $data['thekey'] = $_POST["name"];
            $data['isi']  = $this->slug($_POST["value"]);
            
			if($setting_id <> '0' ){
				$updated = \Dee::$app->db->update('nilai', $data , ['value_id' => $setting_id]);
			} else {
			    $data['niw']  = Dee::$app->niw ;
			    $updated = \Dee::$app->db->insert('nilai', $data );
			}
			
			
			if(isset($updated)){
				$response['status'] = "success";
				$response['message'] = "Data has been save";
				$response['redirect'] = "";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data couldn't save";
			}
		}
		return $response;
	}
  public function insertPages(){
    
		$data = $_POST['pages'];
		$response['status'] = "error";
		$response['message'] = "Please check your input";
		if(isset($data)){
			    
                $data['judul_menu'] = (isset($data['judul_menu'])) ? $data['judul_menu'] : substr($data['title'],0,15).'..' ;
			    $data['slug'] = $this->slug($data['title']);
                
                
            if($data['pages_id'] <> ''){
            	$insert_id = \Dee::$app->db->update("pages", $data, ["pages_id" => $data['pages_id'] ]);
            }else{
                $aku['judul_menu']= $data['judul_menu'];
                $aku['parent']    = '5';
                $aku['title']     = $data['title'];
                $aku['slug']      = $data['slug'];
                $aku['content']   = $data['content'];
                $aku['type']      = $data['type'];
                $aku['views']     = '223';
                $aku['niw'] = Dee::$app->niw;
                $aku['status'] = '0';
                $insert_id = \Dee::$app->db->insert("pages",$aku);
            }
			 
				if(isset($insert_id) && !empty($insert_id)){
					$response['status'] = "success";
					$response['message'] = "Data berhasil save";
					$response['redirect'] = "admin/pages";
				} else {
					$response['message'] = "Data couldn't save";
				}
			
		}
		return $response;
	}

	public function delete(){
		$id 					= $_POST['id'];
		$response['status'] 	= "error";
		$response['message'] 	= "Please check your selected data";
		if(isset($id)){
			
			$delete = \Dee::$app->db->delete('nilai', ['value_id' => $id]); 
            
			if(isset($delete) && $delete == TRUE){
				$response['status'] = "success";
				$response['message'] = "Data has been deleted";
				$response['redirect'] = "";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data Tidak deleted";
			}
		}
		return $response; 
	}
    
	public function delPages(){
		$id 					= $_POST['id'];
		$response['status'] 	= "error";
		$response['message'] 	= "Please check your selected data";
		if(isset($id)){
			
            $parent = \Dee::$app->db->queryOne("SELECT  * FROM `pages` WHERE `pages_id`='".$id."'");
			$delete 	= \Dee::$app->db->delete("pages",["`pages_id`" => $id ]);
            
			if(isset($delete) && $delete == TRUE){
				$response['status'] = "success";
				$response['message'] = "Data has been deleted";
				$response['redirect'] = "";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data Tidak deleted";
			}
		}
		return $response; 
	}
	public function slug($text){
		$first	= str_replace(array('"',"'"),'',$text);
		$second = preg_replace('/[^a-zA-Z0-9\s\-]/mi','',urldecode($first));
		$third 	= preg_replace('!\s+!','-',$second);
		$result = preg_replace('!-+!','-',$third);
		return strtolower($result);
	}


}