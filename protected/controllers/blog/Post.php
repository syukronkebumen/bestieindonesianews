<?php
namespace app\controllers;

use dee\base\Controller;
use Dee;
class Post extends Controller
 {
	private $head;
    private $post;
    private $berita;

    public function __construct(){

     $this->berita          =  new \app\models\Berita();
     $this->head            = new \app\models\Head();
     $this->post            = new \app\models\Post();
	}

	public function actionIndex(){

		$data               = $this->berita->berita();
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];
        $item['theme']      = '../public/themes/'.$item['web']['theme'];
	    $item['title']      = 'List of Post';
        $item['description']= 'List of Post';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'category';
        $data['artikel']    = $this->berita->populer();
        $data['nav']        = 'List of Post';
        $data['cat']        = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme'] = '../public/themes/'.$theme;
		$html               = $this->render($item['web']['theme']."/head",$item);
        $html              .= $this->render($theme. "/blog",$data);
        $html              .= $this->render($theme. "/footer",$foot);
		return $html;
	}
   
    public function actionRead($slug = ''){

	    $model               = new \app\models\Home();
        $data['single']     = $this->post->get_berita($slug);
        $data['artikel']    = $this->post->artikel();
        $data['berita_populer']    = $this->post->berita_populer();
        $data['related_article'] = $this->post->related_article();
        $data['art_lain']   = $model->artikel_lain($data['single']['category']);
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];

        $item['theme']      = '../public/themes/'.$theme;
	    $item['title']      = $data['single']['title'];
        $item['description']= $data['single']['content'];
     
        $data['artikelImage']       =isset($data['single']['img_header']) && is_file(Dee::$app->basePathe . '/uploads/artikel/' . $data['single']['img_header']) ? Dee::$app->baseUrl . '/public/uploads/artikel/' . $data['single']['img_header'] : Dee::$app->baseUrl . '/public/assets/images/no-image/poster.jpg';
    
        $item['gambar']     = $data['artikelImage'];
        $item['is_active']  = $data['single']['isi'];
        $data['nav']        = 'List of Post';
        $data['category']   = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme'] = '../public/themes/'.$theme;

		$html               = $this->render($theme. "/head",$item);
        $html              .= $this->render($theme. "/single",$data);
        $html              .= $this->render($theme. "/footer",$foot);
        return $html;
	}
    public function actionPages($slug = ''){

        $data['single']     =  $this->post->get_pages($slug);
        $data['allPages']   =  $this->post->pagesAll();
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];

        $item['theme']      =  '../public/themes/'.$theme;
	    $item['title']      = $data['single']['title'];
        $item['description']= $data['single']['content'];
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'profile';
        $item['is_active2'] = $data['single']['judul_menu'];
        $data['nav']        = 'List of Page';
        $data['category']   = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme']      = '../public/themes/'.$theme;
		$html               = $this->render($theme. "/head",$item);
        $html              .= $this->render($theme. "/pages",$data);
        $html              .= $this->render($theme. "/footer",$foot);
    	return $html;
	}
    public function actionBaca($slug = ''){

        $dat     =  $this->post->get_baca($slug);
        ($dat != null) ? $data['single']= $dat : header('location:../');
        $item               = $this->head->get_settings();
        $data['polres']    = $this->post->polres();
        $theme              = $item['web']['theme'];
        $data['artikelImage'] = ($data['single']['author'] == 1 ) ? 'https://polreslampungtimur.com/upload/berita/'.$data['single']['img_header'] : 'https://polreslampungtimur.com/upload/kegiatan/'.$data['single']['img_header'];
        $item['theme']      =  '../public/themes/'.$theme;
	    $item['title']      = $data['single']['title'];
        $item['description']= $data['single']['content'];
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'portofolio';

        $data['nav']        = 'List of Page';
        $data['category']   = $item['category'];
        $data['web']        = $item['web'];
        $foot               = $this->head->get_footer();
        $foot['theme']      = '../public/themes/'.$theme;
		$html               = $this->render($theme. "/head",$item);
        $html              .= $this->render($theme. "/baca",$data);
        $html              .= $this->render($theme. "/footer",$foot);
    	return $html;
	}
    public function actionCategory($cat = ''){

		
        
        $data               = $this->berita->category($cat);
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];
        $item['is_active5'] = $cat <> 'kinerja-opd' ? 'berita' : null;
        $item['is_active']  = $cat;
        $item['theme']      = '../public/themes/'. $theme;
	    $item['title']      = 'List of Category';
        $item['description']= 'List of Category';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $data['populer']    = $this->berita->populer();
        $data['category']   = $item['category'];
        $data['artikel']    = $this->post->artikel();
        $foot               = $this->head->get_footer();
        $foot['theme']      = '../public/themes/'.$theme;
		$html               = $this->render($theme. "/head",$item);
		$html              .= $this->render($theme. "/blog",$data);
        $html              .= $this->render($theme. "/footer",$foot);
		return $html;
	}
    public function actionKinerja($cat = 'kinerja-opd'){

		
        
        $data               = $this->berita->kinerja();
        $item               = $this->head->get_settings();
        $theme              = $item['web']['theme'];
        $item['is_active2'] = 'kinerja' ;
        $item['is_active']  = 'gallery';
        $item['theme']      = './public/themes/'. $theme;
	    $item['title']      = 'Gallery Kinerja OPD';
        $item['description']= 'Gallery Kinerja OPD';
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $foot               = $this->head->get_footer();
        $foot['theme']      = './public/themes/'.$theme;
		$html               = $this->render($theme. "/head",$item);
		$html              .= $this->render($theme. "/gal-kinerja",$data);
        $html              .= $this->render($theme. "/footer",$foot);
		return $html;
	}
    }
