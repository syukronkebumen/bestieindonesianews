<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Pages extends Controller 
{
    private $model;
    private $head;
   
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('panel');
     $this->model =  new \app\models\admin\Pages();
     $this->head =  new \app\models\admin\Dashboard();
	}

	public function actionIndex(){
	    $head     = $this->head->header();
        $head['is_active'] = 'pages';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Data Menu Website';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Menu', 'href'=>'admin/pages'),
			array('title'=>'Detail',  'is_active'=>TRUE)
		);
		        
		$access = array(
			"form_title" 			=> 'Daftar Isian menu',
			"form_action_url" 		=> 'admin/pages/insert',
			"table_url" 		    => Dee::createUrl('/admin/pages/get-page?parent=5'),
            "table_url_a" 		    => Dee::createUrl('/admin/pages/get-page?parent='),
            "form_action_pages" 	=> Dee::createUrl('admin/pages/form'),
            "detail_url" 		    => '',
            "parent"			    => '',
            "settings" 		        => $this->model->getAll(),
            "delete_url" 			=> Dee::createUrl('admin/pages/delete'),
			"table_title"			=> 'Menu Website'
			
		);
		
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/pages",$access);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    
   public function actionDetail($id =''){
        
        $head     = $this->head->header();
        $head['is_active'] = 'pages';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Data Menu Website';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Menu', 'href'=>'admin/pages'),
			array('title'=>'Detail',  'is_active'=>TRUE)
		);
		$menu_id = $_GET['id'];
        
		$access = array(
			"form_title" 			=> 'Daftar Isian menu',
			"form_action_url" 		=> Dee::createUrl('admin/pages/insert'),
            "form_action_pages" 	=> Dee::createUrl('admin/pages/form'),
			"table_url" 		    => Dee::createUrl('/admin/pages/get-page?parent='.$menu_id),
			"delete_url" 			=> Dee::createUrl('admin/pages/delete'),
            "delete_pages" 			=> Dee::createUrl('admin/pages/del-pages'),
			"table_title"			=> 'Menu Website',
            "settings" 		        => $this->model->getAll(),
            "parent"			    => $menu_id,
			"form"					=> TRUE
		);
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/pages",$access);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
   public function actionGetPage(){
    
		$result         = $this->model->getPage();
        $data['data'] = array();
        foreach ($result as $key => $value) {
			$title   = substr($value['judul_menu'],0,50);
            $content = substr($value['title'],0,70);
            $ops = '<div class="btn-group fa-pull-right">';
			$ops .= '	<a href="'.Dee::createUrl('admin/pages/form?id=' . $value['pages_id']).'"  class="btn btn-sm btn-outline-primary" ><i class="fa fa-edit"></i></a>';
			$ops .= '	<button type="button" onclick="remove(\'' . $value['pages_id'] .'\',\''.Dee::createUrl('admin/pages/del-pages').'\')" class="btn btn-sm btn-outline-danger" ><i class="fa fa-trash"></i></button>';
			$ops .= '</div>';
			
			$data['data'][$key] = array(
				$title,
                $content,
                $ops,
			);
		} 
        
		Dee::$app->response->format = "json";
        
		return $data;
	}
    
   
    public function actionForm(){
        
        if(isset($_POST['parent'])){
            $parent	            = $_POST['parent'];
            $pages              = null;
             
            }else{
             $id     = $_GET['id'];
             $pages  = \Dee::$app->db->queryOne("SELECT `art`.*	FROM `pages` AS `art` WHERE `art`.`pages_id`='". $id ."'");   
             $parent = $pages['parent'];
             $form['pages_id']   = $pages['pages_id'];
             $form['judul_menu'] = $pages['judul_menu'];
             $form['type']       = $pages['type'];
             $form['title_m']      = $pages['title'];
             $form['content']    = $pages['content'];
            }
            
		$head     = $this->head->header();
        $head['is_active'] = 'pages';
       	$html = $this->render("admin/parts/header",$head);
		
		
		$breadcrumbs['title'] = 'Menu Website';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'dashboard'),
			array('title'=>'Menu', 'href'=>'pages'),
			array('title'=>'Form', 'is_active'=>TRUE)
		);
		
		
		$form['title']		 		= "Edit Menu";
		$form['action_url'] 		= Dee::createUrl("admin/pages/insert-pages");
		$form['parent'] 		    = $parent;
        $form['pages'] 		        = $pages;
		$form['menu'] 		        = $this->model->getAll();
		$form['delete_url'] 		= Dee::createUrl('admin/pages/delete');
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/form_pages",$form);
		$html .= $this->render("admin/parts/footer");
		return $html;
		
	}
    
  	public function actionInsertVal(){
	    Dee::$app->response->format = "json";
		return $this->model->updateVal();
	}
   public function actionInsertPages(){
		Dee::$app->response->format = "json";
		return $this->model->insertPages();
	}
	public function actionDelete(){
	    Dee::$app->response->format = "json";
		return $this->model->delete();
	}
    public function actionDelPages(){
		Dee::$app->response->format = "json";
		return $this->model->delPages();
	}
   public function actionDetaili(){
	    Dee::$app->response->format = "json";
		return $this->model->getAll();
	}
public function actionIsi(){
        $id = $_POST['id'] ;
        $data['url'] = 'admin/pages/get-page?parent='.$id;
	    Dee::$app->response->format = "json";
		return $data;
	}	
}