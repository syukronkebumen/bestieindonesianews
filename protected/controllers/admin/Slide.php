<?php

namespace app\controllers;

use dee\base\Controller;

use Dee;

class Slide extends Controller {
    private $model;
    private $head;
   
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('panel');
      $this->model =  new \app\models\admin\Slide();
      $this->head =  new \app\models\admin\Dashboard();
	}
    
	public function actionIndex($dat = false){
	   
       $dat == true ? $cat = $dat['cat'] : $cat = '1';
       $form = $dat['form'] <> '' ? $dat['form'] : 'Slide'; 
       $data = $this->model->lists($cat);
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of '.$form;
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of Slide', 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of '.$form;
        $data['cat']   = $cat;
		$data['upload_url'] 			= Dee::createUrl('admin/slide/upload');
        $data['simpan_url'] 			= Dee::createUrl('admin/slide/simpan');
		$data['delete_url'] 			= Dee::createUrl('admin/slide/delete');
		$data['delete_multiple_url'] 	= Dee::createUrl('admin/slide/delete-multiple');
        $data['getOne'] 	            = Dee::createUrl('admin/slide/get-one');
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/slide/lists",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    public function actionYoutube($dat = false){
	   
       $dat == true ? $cat = $dat['cat'] : $cat = '10';
       
       $data = $this->model->lists($cat);
       
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of Youtube';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of Slide', 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of Youtube';
        $data['cat']   = $cat;
		$data['simpan_url'] 			= Dee::createUrl('admin/slide/simpan');
		$data['delete_url'] 			= Dee::createUrl('admin/slide/delete');
		$data['getone'] 	            =  Dee::createUrl('admin/slide/get-ytb');
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/slide/youtube",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
   
  
  public function actionBanner(){
        $dat['cat']  = '2';
        $dat['form'] = 'Banner';
        echo $this->actionIndex($dat);
	}
  public function actionFoto(){
        $dat['cat']  = '3';
        $dat['form'] = 'Foto';
        echo $this->actionIndex($dat);
	}
     
	public function actionSimpan(){
		Dee::$app->response->format = "json";
		return $this->model->simpan();
	}
    
   public function actionUpload(){
		Dee::$app->response->format = "json";
		return $this->model->upload();
	}
    
	public function actionDelete(){
		Dee::$app->response->format = "json";
		return $this->model->delete();
	}

	public function actionDeleteMultiple(){
		Dee::$app->response->format = "json";
		return $this->model->delete_multiple();
	}
    public function actionGetOne(){
		Dee::$app->response->format = "json";
		return $this->model->getOne();
	}
    public function actionGetYtb(){
		Dee::$app->response->format = "json";
		return $this->model->getYtb();
	}
}