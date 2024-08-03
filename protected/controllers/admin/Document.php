<?php

namespace app\controllers;

use dee\base\Controller;

use Dee;

class Document extends Controller {
    private $model;
    private $head;
   
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('panel');
      $this->model =  new \app\models\admin\Dokumen();
      $this->head =  new \app\models\admin\Dashboard();
	}
    
	public function actionIndex($dat = false){
	   
       if($dat == true){ $cat = $dat['cat'] ;$nav = $dat['form'];}else{ $cat = '4'; $nav = 'dokumen';}
       
       $data = $this->model->lists($cat);
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of '. $nav ;
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of '. $nav, 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of '. $nav;
        $data['cat']   = $cat;
		$data['upload_url'] 			= Dee::createUrl('admin/document/upload');
        $data['simpan_url'] 			= Dee::createUrl('admin/document/simpan');
		$data['delete_url'] 			= Dee::createUrl('admin/document/delete');
		$data['delete_value'] 	        = Dee::createUrl('admin/value/delete');
        $data['getOne'] 	            = Dee::createUrl('admin/document/get-one');
        $data['category']               = $this->actionSelectAccess();
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/". $nav ,$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    
   public function actionSdm($dat = false){
	   
       $dat == true ? $cat = $dat['cat'] : $cat = '5';
        
       $data = $this->model->listswarga($cat);
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of SDM';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of SDM', 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of SDM';
        $data['cat']   = $cat;
		$data['upload_url'] 			= Dee::createUrl('admin/document/upload');
        $data['simpan_url'] 			= Dee::createUrl('admin/document/simpan-warga');
		$data['delete_url'] 			= Dee::createUrl('admin/document/delete');
		$data['upload_warga'] 	        =  Dee::createUrl('admin/document/upload-warga');
        $data['getOne'] 	            =  Dee::createUrl('admin/document/get-one');
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/warga",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
  public function actionLink($dat = false){
	   
       $dat == true ? $cat = $dat['cat'] : $cat = '7';
       
       $data = $this->model->lists($cat);
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of Link';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of Link', 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of Link';
        $data['cat']   = $cat;
		$data['upload_url'] 			= Dee::createUrl('admin/document/upload');
        $data['simpan_url'] 			= Dee::createUrl('admin/document/simpan');
		$data['delete_url'] 			= Dee::createUrl('admin/document/delete');
		$data['delete_multiple_url'] 	= Dee::createUrl('admin/document/delete-multiple');
        $data['getOne'] 	            = Dee::createUrl('admin/document/get-one');
        $data['category']               = $this->actionSelectAccess();
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/link",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    
  public function actionMusik($dat = false){
	   
       if($dat == true){ $cat = $dat['cat'] ;$nav = $dat['form'];}else{ $cat = '6'; $nav = 'dokumen';}
       
       $data = $this->model->lists($cat);
       $head     = $this->head->header();
       $head['is_active'] = 'slide-'.$cat; 
       $html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'List of '. $nav ;
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Dashboard', 'href'=>'admin/dashboard'),
			array('title'=>'List of '. $nav, 'is_active'=>TRUE)
		);
        
		$data['title'] = 'List of '. $nav;
        $data['cat']   = $cat;
		$data['upload_url'] 			= Dee::createUrl('admin/document/upload');
        $data['simpan_url'] 			= Dee::createUrl('admin/document/simpan');
		$data['delete_url'] 			= Dee::createUrl('admin/document/delete');
		$data['delete_value'] 	        = Dee::createUrl('admin/value/delete');
        $data['getOne'] 	            = Dee::createUrl('admin/document/get-one');
        $data['category']               = $this->actionSelectAccess();
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
        $html .= $this->render("admin/musik",$data);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
  
   public function actionSelectAccess(){
	   $sql 		= "SELECT * FROM `nilai` WHERE `thekey`='dokumen' AND `niw`='".Dee::$app->niw."' ORDER BY value_id DESC";
    	return \Dee::$app->db->queryAll($sql);
	}  
	public function actionSimpan(){
		Dee::$app->response->format = "json";
		return $this->model->simpan();
	}
    public function actionSimpanWarga(){
		Dee::$app->response->format = "json";
		return $this->model->simpanWarga();
	}
    
   public function actionUpload(){
		Dee::$app->response->format = "json";
		return $this->model->upload();
	}
    public function actionUploadWarga(){
		Dee::$app->response->format = "json";
		return $this->model->uploadWarga();
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
    
}