<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Disclaimer extends Controller {
    public function actionIndex(){
        // $data['theme'] = 'bappeda';
        // return $this->render('bappeda/disclaimer.php', $data);

        $head                = new \app\models\Head();
        // $model               = new \app\models\Home();
        $item                = $head->get_settings();
        // echo "<pre>";
        // print_r($item);
        // echo "</pre>";
        // exit();
        $theme              = $item['web']['theme'];
        $item['theme']      =  'public/themes/'.$item['web']['theme'];
        // $item['title']      = 'BestieIndonesiaNews | Desclaimer';
        // $item['description']= 'BestieIndonesiaNews | Desclaimer';
        // $item['gambar']     = $item['theme'].'/theme.jpg';
        // $item['is_active']  = 'dokumen';
        

        // $data['nav'] = 'Desclaimer';
        // // $data['artikel']     = $model->artikel();
        // // $data['folder']      = $this->_value();
        // // $data['data']        = $this->_lists();
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
	
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($theme. "/disclaimer");
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

      	return $html;
	}
}