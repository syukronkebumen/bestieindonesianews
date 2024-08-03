<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

 

class Settings extends Controller {
    
    public $id;
    private $settings;
 
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('admin');
     $this->settings = new \app\models\admin\Settings();
     $this->id           = $this->settings->data()['id']; 
	}
    
	public function actionIndex(){
		
		$model    =  new \app\models\admin\Dashboard();
        
        $head     = $model->header();
        $head['is_active'] = 'settings';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Pengaturan';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'dashboard'),
			array('title'=>'Daftar Data', 'is_active'=>TRUE)
		);
		$html 				.= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$data              	= $this->settings->data();
                 
        $data['thema']      = $this->settings->directorymap(Dee::$app->basePathe.'/themes/',1);
		$data['title']		= 'Daftar Data Pengaturan';
		$html 				.= $this->render("admin/settings",$data);
		$html 				.= $this->render("admin/parts/footer");
		
		return $html;
	}

	public function actionUpdate(){
	    Dee::$app->response->format = "json";
		return $this->settings->update();
        
	}

	public function actionLogo(){
		Dee::$app->response->format = "json";
		return $this->upload();
	}
  
  public function upload(){
    
			$file 	= $_FILES["file"];
                      
			if(	isset($file['tmp_name']) && !empty($file['tmp_name']) ){
				$oldphoto = \Dee::$app->db->queryOne("SELECT `logo` FROM `setting` WHERE `id`='". $this->id ."'");
					if(is_file(Dee::$app->basePathe .'/uploads/' . $oldphoto['logo'])){
						unlink(Dee::$app->basePathe .'/uploads/' . $oldphoto['logo']);
					}
                    
                $img = $this->uploader();
                }
              	$dat['logo'] 			= $img;
			    
                $updated = \Dee::$app->db->update('setting', $dat , ['id' => $this->id]);
                
				if(isset($updated) && $updated == TRUE){
					$response['status'] = "success";
					$response['message'] = "Data has been save";
					$response['redirect'] = "admin/settings";
				} else {
					$response['status'] = "error";
					$response['message'] ="Image gagal di upload";
				}
			
            return $response;
		}
    public function uploader()
   {
        $uploader = new \app\models\admin\Uploader();
     	$uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx'));  
        $uploader->setMaxSize(5);                          
        $uploader->setDir(Dee::$app->basePathe .'/uploads/');
        //$uploader->getThumb(100);
        //$uploader->reSize(200,200);
    
    if($uploader->uploadFile('file'))          
    {   
        $data  =   $uploader->getUploadName(); 
    }
        return $data;
    }
}