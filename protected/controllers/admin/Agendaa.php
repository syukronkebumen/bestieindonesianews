<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Agendaa extends Controller 
{
    private $model;
    private $head;
   
    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('panel');
     $this->model =  new \app\models\admin\Agendaa();
     $this->head =  new \app\models\admin\Dashboard();
	}

	public function actionIndex(){
	    $head     = $this->head->header();
        $head['is_active'] = 'agenda';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Data Agenda';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Menu', 'href'=>'admin/agendaa'),
			array('title'=>'Detail',  'is_active'=>TRUE)
		);
		        
		$access = array(
			"form_title" 			=> 'Daftar Agenda',
			"form_action_url" 		=> 'admin/agenda/insert',
			"table_url" 		    => Dee::createUrl('/admin/agendaa/get-page'),
            "table_url_a" 		    => Dee::createUrl('/admin/agendaa/get-page?parent='),
            "form_action_agenda" 	=> Dee::createUrl('admin/agendaa/form'),
            "detail_url" 		    => '',
            "parent"			    => '',
            
            "delete_url" 			=> Dee::createUrl('admin/agendaa/delete'),
			"table_title"			=> 'Agenda'
			
		);
		
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/agenda",$access);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
    
   public function actionDetail($id =''){
        
        $head     = $this->head->header();
        $head['is_active'] = 'agenda';
       	$html = $this->render("admin/parts/header",$head);
        
		$breadcrumbs['title'] = 'Data Agenda';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Menu', 'href'=>'admin/agenda'),
			array('title'=>'Detail',  'is_active'=>TRUE)
		);
		$menu_id = $_GET['id'];
        
		$access = array(
			"form_title" 			=> 'Daftar Isian menu',
			"form_action_url" 		=> Dee::createUrl('admin/agendaa/insert'),
            "form_action_agenda" 	=> Dee::createUrl('admin/agendaa/form'),
			"table_url" 		    => Dee::createUrl('/admin/agendaa/get-page?parent='.$menu_id),
			"delete_url" 			=> Dee::createUrl('admin/agendaa/delete'),
            "delete_agenda" 			=> Dee::createUrl('admin/agendaa/del-agenda'),
			"table_title"			=> 'Agenda',
            "settings" 		        => $this->model->getAll(),
            "parent"			    => $menu_id,
			"form"					=> TRUE
		);
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/agenda",$access);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}
   public function actionGetPage(){
        $date = new \app\models\Date();
		$result         = $this->model->getPage();
        $data['data'] = array();
        foreach ($result as $key => $value) {
			$title   = $value['tema'];
            $content = $date->indonesia($value['tgl_pelaksanaan'],"d M Y");
            $ops = '<div class="btn-group fa-pull-right">';
			$ops .= '	<a href="'.Dee::createUrl('admin/agendaa/form?id=' . $value['agenda_id']).'"  class="btn btn-sm btn-outline-primary" ><i class="fa fa-edit"></i></a>';
			$ops .= '	<button type="button" onclick="remove(\'' . $value['agenda_id'] .'\',\''.Dee::createUrl('admin/agendaa/del-agenda').'\')" class="btn btn-sm btn-outline-danger" ><i class="fa fa-trash"></i></button>';
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
        
             
             if(isset($_GET['id'])){
              
             $id = $_GET['id'];
             $form  = \Dee::$app->db->queryOne("SELECT `art`.*	FROM `agenda` AS `art` WHERE `art`.`agenda_id`='". $id ."'");   
             }
          	$head     = $this->head->header();
            $head['is_active'] = 'agenda';
       	    $html = $this->render("admin/parts/header",$head);
		
		
		$breadcrumbs['title'] = 'Agenda';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'dashboard'),
			array('title'=>'Menu', 'href'=>'agenda'),
			array('title'=>'Form', 'is_active'=>TRUE)
		);
		
		
		$form['title']		 		= "Form Agenda";
		$form['action_url'] 		= Dee::createUrl("admin/agendaa/insert-agenda");
		$form['delete_url'] 		= Dee::createUrl('admin/agendaa/delete');
		
        $html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);
		$html .= $this->render("admin/form_agenda",$form);
		$html .= $this->render("admin/parts/footer");
		return $html;
		
	}
    
  	public function actionInsertVal(){
	    Dee::$app->response->format = "json";
		return $this->model->updateVal();
	}
   public function actionInsertagenda(){
		Dee::$app->response->format = "json";
		return $this->model->insertagenda();
	}
	public function actionDelete(){
	    Dee::$app->response->format = "json";
		return $this->model->delete();
	}
    public function actionDelagenda(){
		Dee::$app->response->format = "json";
		return $this->model->delagenda();
	}
   public function actionDetaili(){
	    Dee::$app->response->format = "json";
		return $this->model->getAll();
	}
public function actionIsi(){
        $id = $_POST['id'] ;
        $data['url'] = 'admin/agenda/get-page?parent='.$id;
	    Dee::$app->response->format = "json";
		return $data;
	}	
}