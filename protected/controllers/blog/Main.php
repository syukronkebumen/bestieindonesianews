<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Main extends Controller {

      public function __construct(){
	    $this->niw    = Dee::$app->niw;
	   }
    	public function actionIndex()
        {
	    $head                = new \app\models\Head();
        $model               = new \app\models\Home();
        
        $item                = $head->get_settings();

        $item['theme']       = 'public/themes/'.$item['web']['theme'];
	   // $item['title']       = 'Website Resmi ||  '.$item['web']['instansi'];
        // $item['description'] =  $item['web']['description'];
        // $item['gambar']      =  $item['theme'].'/theme.jpg';
        $item['is_active']   = 'home';

        $data['nav']         = 'List of Post';
        $data['theme']       = $item['theme'];
        $data['web']         = $model->get_settings();
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
		$data['slide']       = $model->slide();
        $data['artikel']     = $model->artikel();
        //$data['kegiatan']    = $model->artikel_lain(2);
        //$data['kesiswaan']    = $model->artikel_lain(41);
        //$data['info']        = $model->info('Berita');
        $data['agenda']      = $model->info();
        $data['link']        = $foot['link'];
        $data['youtube']     = $model->youtube();
        $data['galery']      = $model->galery();
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($item['web']['theme']."/home",$data);
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

		return $html;
	}
   
    public function actionContact()
        {
        $head                = new \app\models\Head();
        $post                = new \app\models\Post();
        $item                = $head->get_settings();
        $foot                = $head->get_footer();
        $item['theme']       = 'public/themes/'.$item['web']['theme'];
	    $item['title']       = 'Contact || '.Dee::$app->baseUrl;
        $item['description'] =  $item['web']['description'];
        $item['gambar']      =  $item['theme'].'/theme.jpg';
        $item['is_active']   = 'contact';
        $foot['allPages']    =  $post->pagesAll();
        $foot['theme']       = $item['theme'];
        $foot['nav']         = 'Hubungi Kami';
        $html                = $this->render($item['web']['theme']."/head",$item);
        $html               .= $this->render($item['web']['theme']."/contact",$foot);
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

		return $html;
	}

   

   
    public function actionHeadline()
        {
            $model          = new \app\models\Home();
            $result         = $model->artikel();

        $data = array();
        foreach ($result as $value) {

	        $item['image'] = isset($value['img_header']) && is_file(Dee::$app->basePathe.'/uploads/artikel/' . $value['img_header']) ? Dee::$app->baseUrl.'/uploads/artikel/' . $value['img_header'] : Dee::$app->baseUrl .'/assets/images/no-image/poster.jpg';
         	$item['title'] = substr($value['title'],0,30);
            $item['slug']  = $value['slug'];
            $item['content'] = strip_tags(substr($value['content'],0,150));
			$data[] = $item;

		}
            $resul['lists'] = $data;
         Dee::$app->response->format = "json";
		 return $resul;
            }

    public function actionLainnya()
        {
            $model          = new \app\models\Home();
            $result         = $model->artikel_lain();

        $data = array();
        foreach ($result as $value) {
            $img = $this->image(Dee::$app->baseUrl.'/uploads/artikel/thumb/' . $value['img_header']);
	        $item['image'] = isset($value['img_header']) && is_file(Dee::$app->basePathe.'/uploads/artikel/thumb/' . $value['img_header']) ? $img : Dee::$app->baseUrl .'/assets/images/no-image/poster.jpg';
         	$item['title'] = substr($value['title'],0,30);
            $item['slug']  = $value['slug'];
            $item['content'] =  strip_tags(substr($value['content'],0,150));
			$data[] = $item;

		}
            $resul['lists'] = $data;
         Dee::$app->response->format = "json";
		 return $resul;
            }

	public function curi($url){
    		 $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_HEADER, 0);
             $output = curl_exec($ch);
            curl_close($ch);
            return    $output;

			}

   

  public function image($img)   {
    $content	= file_get_contents($img);
    $base_64	= base64_encode($content);
    $src		= 'data:'.mime_content_type($img).';base64,'.$content;
    return $src;
    }
  public function get_web_page( $url )
{
   $options = array(
   CURLOPT_RETURNTRANSFER => true,
   CURLOPT_HEADER => false,
   CURLOPT_FOLLOWLOCATION => true,
   CURLOPT_ENCODING => "",
   CURLOPT_USERAGENT => "spider",
   CURLOPT_AUTOREFERER => true,
   CURLOPT_CONNECTTIMEOUT => 120,
   CURLOPT_TIMEOUT => 120,
   CURLOPT_MAXREDIRS => 10,
   CURLOPT_SSL_VERIFYPEER => false
   );
   $ch = curl_init( $url );
   curl_setopt_array( $ch, $options );
   $content = curl_exec( $ch );
   $err = curl_errno( $ch );
   $errmsg = curl_error( $ch );
   $header = curl_getinfo( $ch );
   curl_close( $ch );
   return $content;
}

public function tag_contents($string, $tag_open, $tag_close){
   foreach (explode($tag_open, $string) as $key => $value) {
       if(strpos($value, $tag_close) !== FALSE){
            $result[] = substr($value, 0, strpos($value, $tag_close));;
       }
   }
   return $result;
}
  public function actionSitemap()
        {
	    $head                = new \app\models\Head();
        $item                = $head->get_settings();
		$art 		= "SELECT *	FROM `artikel` WHERE `niw`='". $this->niw ."' ORDER BY id DESC ";
        $data['artikel']     = \Dee::$app->db->queryAll($art);
        $pol = "SELECT * FROM `polres`  ORDER BY id DESC ";
	    $data['polres']      = \Dee::$app->db->queryAll($pol);
      	$html               .= $this->render($item['web']['theme']."/sitemap",$data);
		return $html;
	}
}
