<?php

namespace app\controllers;

use dee\base\Controller;

use Dee;

class Dashboard extends Controller
 {
	
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('admin');
	}
    
    public function actionIndex(){
		$model =  new \app\models\admin\Dashboard();
        $head     = $model->header();
        $head['is_active'] = 'dashboard';
       	$html = $this->render("admin/parts/header",$head);
       	
      	$html .= $this->render('admin/dashboard/diskspace',$model->get_diskspace());
		$html .= $this->render('admin/dashboard/visitors',$model->get_visitors());
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    
    public function actionLogout()
    {
        Dee::$app->user->logout();
        Dee::redirect('panel');
    }
   	
}