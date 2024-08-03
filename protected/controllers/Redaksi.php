<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Redaksi extends Controller {
    public function actionIndex(){
        $head                = new \app\models\Head();
        $item                = $head->get_settings();
        $theme              = $item['web']['theme'];
        $item['theme']      =  'public/themes/'.$item['web']['theme'];
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
	
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($theme. "/redaksi");
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

      	return $html;
	}
}