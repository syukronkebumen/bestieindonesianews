<?php
namespace app\models\admin;

use Dee;

class Value
 {
    public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
    
    public function getAll(){
		$query 		= "SELECT * FROM `nilai` WHERE `thekey`='artikel' AND `niw`='".$this->niw."' ORDER BY value_id DESC";
		return \Dee::$app->db->queryAll($query);
	}
   
   public function update(){
		$response['status']		= "error";
		$response['message']	= "Please check your input";
        
		if(isset($_POST)){
			$setting_id 	= $_POST["pk"];
            $data['thekey'] = $_POST["name"];
            $data['isi']  = $this->slug($_POST["value"]);
            
			if($setting_id <> '0' ){
				$updated = \Dee::$app->db->update('nilai', $data , ['value_id' => $setting_id]);
			} else {
			    $data['niw'] = $this->niw;
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
	
	public function slug($text){
		$first	= str_replace(array('"',"'"),'',$text);
		$second = preg_replace('/[^a-zA-Z0-9\s\-]/mi','',urldecode($first));
		$third 	= preg_replace('!\s+!','-',$second);
		$result = preg_replace('!-+!','-',$third);
		return strtolower($result);
	}

}