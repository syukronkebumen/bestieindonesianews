<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Dokumen extends Controller {


      public function actionIndex(){
        $head                = new \app\models\Head();
        $model               = new \app\models\Home();
        $item                = $head->get_settings();

        $theme              = $item['web']['theme'];
        $item['theme']      =  'public/themes/'.$item['web']['theme'];
        $item['title']      = 'List of Gallery Dokumen';
        $item['description']= 'List of Gallery Dokumen';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'dokumen';
        

        $data['nav'] = 'Dokumen';
        $data['artikel']     = $model->artikel();
        $data['folder']      = $this->_value();
        $data['data']        = $this->_lists();
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
	
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($theme. "/dokumen",$data);
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

      	return $html;
	}
	
    
   public function _value(){

		$data = "SELECT * FROM `nilai` WHERE `thekey`= 'dokumen' ";
	    return \Dee::$app->db->queryAll($data);
	} 
    private function _lists(){
		
		$pagination = new \app\models\Pagination();
	
		$page = isset($_GET['hal']) && !empty($_GET['hal']) ? (int)$_GET['hal'] : 1;
		$query = "
		SELECT `f`.*
		FROM `galery` AS `f`
		WHERE `f`.`kategori`='4' AND `f`.`status`='0' AND `f`.`niw` = '". Dee::$app->niw ."'
		ORDER BY  `f`.`id` DESC
		";
		$sql = \Dee::$app->db->queryAll($query);
		$pagination->total = count($sql);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 10;
		$pagination->url =  Dee::createUrl('blog/gallery?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$data = \Dee::$app->db->queryAll($query . $limit);
		
		
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
		return $result;
	}
    
}