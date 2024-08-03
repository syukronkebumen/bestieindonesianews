<?php
namespace app\controllers;

use dee\base\Controller;
use Dee;
class Agenda extends Controller
 {
	private $head;
    private $post;
    private $berita;

    public function __construct(){

     $this->head            = new \app\models\Head();
     $this->post            = new \app\models\Agenda();
	}

	public function actionIndex(){

		$data               = $this->post->agenda();
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];
        $item['theme']      = 'public/themes/'.$item['web']['theme'];
	    $item['title']      = 'List of Agenda';
        $item['description']= 'List of Agenda';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'agenda';
        $data['artikel']    = $this->post->artikel();
        $data['nav']        = 'List of Agenda';
        $data['cat']        = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme']       = $item['theme'];
		$html               = $this->render($item['web']['theme']."/head",$item);
        $html              .= $this->render($theme. "/agenda",$data);
        $html              .= $this->render($theme. "/footer",$foot);
		return $html;
	}
   
        
    public function actionBaca($id = ''){

        $dat     =  $this->post->get_baca($id);
        ($dat != null) ? $data['single']= $dat : header('location:../');
        $item               = $this->head->get_settings();
        
        $theme              = $item['web']['theme'];
        $item['theme']      =  '../public/themes/'.$theme;
	    $item['title']      = $data['single']['tema'];
        $item['description']= $data['single']['detail'];
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'agenda';
        $data['artikel']    = $this->post->artikel();
        $data['ag']         = $this->post->agenda();
        $data['nav']        = 'Detail of Agenda';
        $data['category']   = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme']      = '../public/themes/'.$theme;
		$html               = $this->render($theme. "/head",$item);
        $html              .= $this->render($theme. "/baca-agenda",$data);
        $html              .= $this->render($theme. "/footer",$foot);
    	return $html;
	}
    
    }
