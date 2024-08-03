<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Value extends Controller 
{
    private $model;
    private $head;
    
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('admin');
     
       $this->model =  new \app\models\admin\Value();
       $this->head =  new \app\models\admin\Dashboard();
	}
 
 	public function actionIndex(){
 	    
        $head     = $this->head->header();
        $head['is_active'] = 'value';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Data Category Berita';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Berita', 'href'=>'admin/berita'),
			array('title'=>'Category',  'is_active'=>TRUE)
		);
		
		$access = array(
			"form_title" 			=> 'Data category berita',
			"form_action_url" 		=> Dee::createUrl('admin/value/insert'),
			"table_url" 		    => Dee::createUrl('admin/value/get-all'),
			"delete_url" 			=> Dee::createUrl('admin/value/delete'),
			"table_title"			=> 'Category Berita lists',
            "settings"              => $this->model->getAll(),
			"form"					=> TRUE
		);
		
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/berita/val",$access);
		$html .= $this->render("admin/parts/footer");
		
		return $html;
	}
   
   public function actionGetAll(){
		
        $result         = $this->model->getAll();
        $data['data'] = array();
        foreach ($result as $key => $value) {
			$title   = substr($value['value'],0,50);
          	$ops = '<div class="btn-group fa-pull-right">';
			$ops .= '	<a data-toggle="modal" data-target="#modalEdit" data-id="' . $value['value_id'] .'" data-nilai="' . $value['value'] .'" type="button" class="btn btn-sm btn-outline-primary" ><i class="fa fa-edit"></i></a>';
			$ops .= '	<button type="button" data-toggle="modal" data-target="#modalConfirmDelete" data-id="' . $value['value_id'] .'" class="btn btn-sm btn-outline-primary" ><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$title,
				$ops,
			);
		} 
  		Dee::$app->response->format = "json";
   		return $data;
	}
  	public function actionInsert(){
		Dee::$app->response->format = "json";
		return $this->model->insert();
	}
   public function actionUpdate(){
		Dee::$app->response->format = "json";
		return $this->model->update();
	}
	public function actionDelete(){
		Dee::$app->response->format = "json";
		return $this->model->delete();
	}

	
}