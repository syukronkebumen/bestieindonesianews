<?php
namespace app\models\admin;

use Dee;

class Agendaa
 {
    
    public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
        
    
   public function getPage(){
	 
		$query 		= "SELECT * FROM `agenda` ORDER BY tgl_pelaksanaan DESC";
		return \Dee::$app->db->queryAll($query);
	}

	
   
  public function insertAgenda(){
    
		$data = $_POST['agenda'];
		$response['status'] = "error";
		$response['message'] = "Please check your input";
		if(isset($data)){
		
          if($data['agenda_id'] <> ''){
            	$insert_id = \Dee::$app->db->update("agenda", $data, ["agenda_id" => $data['agenda_id'] ]);
            }else{
                $aku['tema']                = $data['tema'];
                $aku['tempat']              = $data['tempat'];
                $aku['detail']              = $data['detail'];
                $aku['tgl_input']           = date('Y-m-d');
                $aku['tgl_pelaksanaan']     = $data['tgl_pelaksanaan'];
                $aku['waktu']               = $data['waktu'];
                $aku['status']              = '0';
                $aku['mandat']              = 'Atasan';
                $aku['views']               = '223';
                $aku['niw']                 = Dee::$app->niw;
                $insert_id = \Dee::$app->db->insert("agenda",$aku);
            }
			 
				if(isset($insert_id) && !empty($insert_id)){
					$response['status'] = "success";
					$response['message'] = "Data berhasil save";
					$response['redirect'] = "admin/agendaa";
				} else {
					$response['message'] = "Data couldn't save";
				}
			
		}
		return $response;
	}

	
	public function delAgenda(){
		$id 					= $_POST['id'];
		$response['status'] 	= "error";
		$response['message'] 	= "Please check your selected data";
		if(isset($id)){
			
        		$delete 	= \Dee::$app->db->delete("agenda",["`agenda_id`" => $id ]);
            
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