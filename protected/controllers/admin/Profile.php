<?php

namespace app\controllers;

use dee\base\Controller;

use Dee;

class Profile extends Controller
 {
    private $model;
    private $head;
    
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('admin');
      $this->model =  new \app\models\admin\Profile();
      $this->head =  new \app\models\admin\Dashboard();
	}
    
	public function actionIndex(){
	    
        $_SESSION["captcha"] = simple_php_captcha();
		$head     = $this->head->header();
        $head['is_active'] = 'profile';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Profile';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Profile', 'is_active'=>TRUE)
		);
        
	    $data 					= $this->model->getview();
        $data['title'] 			= 'Profile';
		$data['update_url'] 	= 'admin/profile/update';
		$data['updatePw_url'] 	= 'admin/profile/update-password';
		$data['upload_url'] 	= 'admin/profile/upload';
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/profile/view",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}

	public function actionUpload(){
		Dee::$app->response->format = "json";
		return $this->model->upload();
	}
    public function actionUpdate(){
		Dee::$app->response->format = "json";
		return $this->model->update();
	}
    
	public function actionUpdatePassword(){
		Dee::$app->response->format = "json";
		return $this->model->updatepw();
	}

}