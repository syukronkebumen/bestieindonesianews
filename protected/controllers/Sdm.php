<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Sdm extends Controller {


      public function actionIndex(){
        $head                = new \app\models\Head();
        $model               = new \app\models\Home();
        $item                = $head->get_settings();

        $theme              = $item['web']['theme'];
        $item['theme']      =  'public/themes/'.$item['web']['theme'];
        $item['title']      = 'List of Gallery SDM';
        $item['description']= 'List of Gallery SDM';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'pages';
        $item['is_active2'] = 'sdm';
        
        $data['nav'] = 'SDM';
        $data['data']        = $this->_lists();
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
	
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($theme. "/sdm",$data);
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

      	return $html;
	}
	
    
   public function _value(){

		$data = "SELECT * FROM `nilai` WHERE `thekey`= 'dokumen' ";
	    return \Dee::$app->db->queryAll($data);
	} 
    private function _lists(){
		
		$query = "
		SELECT `f`.*
		FROM `galery` AS `f`
		WHERE `f`.`kategori`='5' AND `f`.`status`='0' 
		ORDER BY  `f`.`id` DESC
		";
		$data = \Dee::$app->db->queryAll($query);
		
		return $data;
	}
    
}