<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Gallery extends Controller {


      public function actionIndex($dat = false){
        $head                = new \app\models\Head();
        $item                = $head->get_settings();

        $dat == true ? $cat = $dat['cat'] : $cat = '3';
        $nav = $dat['nav'] <> '' ? $dat['nav'] : 'foto';
       
        $theme              = $item['web']['theme'];
        $item['theme']      =  'public/themes/'.$item['web']['theme'];
        $item['title']      = 'List of Gallery '.$nav;
        $item['description']= 'List of Gallery '.$nav;
        $item['gambar']     = $item['theme'].'/theme.jpg';
        $item['is_active']  = 'gallery';
        $item['is_active2']  = $nav;

        $data['nav'] = $nav;
        $data['art']         = $this->_berita();
        $data['ytb']         = $this->_lists('10');
        $data['data']        = $this->_lists($cat);
        $foot                = $head->get_footer();
        $foot['theme']       = $item['theme'];
	
        $html                = $this->render($item['web']['theme']."/head",$item);
       	$html               .= $this->render($theme. "/".$nav ,$data);
        $html               .= $this->render($item['web']['theme']."/footer",$foot);

        	return $html;
	}
	
      
    public function actionVideo(){
        $dat['nav']  = 'video';
        $dat['cat']  = '10';
        echo $this->actionIndex($dat);
	}
        
   
    private function _lists($cat){
		
		$pagination = new \app\models\Pagination();
	
		$page = isset($_GET['hal']) && !empty($_GET['hal']) ? (int)$_GET['hal'] : 1;
		$query = "
		SELECT `f`.*
		FROM `galery` AS `f`
		WHERE `f`.`kategori`='".$cat."' AND `f`.`status`='0' 
		ORDER BY  `f`.`id` DESC
		";
		$sql = \Dee::$app->db->queryAll($query);
		$pagination->total = count($sql);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 8;
		$pagination->url =  Dee::createUrl('blog/gallery?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$data = \Dee::$app->db->queryAll($query . $limit);
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
		return $result;
	}
    
    private function _berita(){
        $sql	= "
			SELECT `art`.*, v.isi AS isi
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
		    ORDER BY art.id DESC
		";
        
        $query = \Dee::$app->db->queryAll($sql);
        return $query;
     }
   public function actionMore(){ 
    $row = isset($_POST['row']) ? $_POST['row'] : '1';
    $rowperpage = 10;

        $query = 'SELECT * from galery WHERE kategori = "3" order by id asc limit '.$row.','.$rowperpage.'';
        $result = \Dee::$app->db->queryAll($query);  

        $html = '';
     if(count($result) > 0){
        foreach($result as $g){
        $artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
				'/uploads/slide/' . $g['image_url']) ? Dee::$app->baseUrl .
				'/public/uploads/slide/' . $g['image_url'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/slide.jpg'; 
			
	   $html .='<div class="gallery-item small-block masonry-item all foto">
					<div class="inner-box">
						 <figure class="image-box" style="height: 200px; background-image: url('. $artikelImage .') ; background-size:cover; background-position: center;">
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="">'.$g['title_img'] .'</a></h3>
										<a href="'. $artikelImage .'" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>';
        }
      }
    echo $html;
    }

 public function actionMoreart(){ 
    $row = isset($_POST['row']) ? $_POST['row'] : '1';
    $rowperpage = 10;

    $query = 'SELECT * from artikel order by id asc limit '.$row.','.$rowperpage.'';
    $result = \Dee::$app->db->queryAll($query);  

        
    $html ='';$k=0;
    foreach($result as $g){
    $artikelImage = isset($g['img_header']) && is_file(Dee::$app->basePathe .
				'/uploads/artikel/' . $g['img_header']) ? Dee::$app->baseUrl .
				'/public/uploads/artikel/thumb/' . $g['img_header'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/slide.jpg'; 
        $k++;        
		$e = ($k - 1) * 250; 	
			
	$html .='<div class="gallery-item small-block masonry-item wow fadeInRight animated" data-wow-delay="'. $e .'ms" data-wow-duration="1500ms">
					<div class="inner-box">
							 <figure class="image-box" style="height: 200px; background-image: url('. $artikelImage .') ; background-size:cover; background-position: center;">
								<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="">'.$g['title'] .'</a></h3>
										<a href="'.Dee::$app->baseUrl .'/public/uploads/artikel/' . $g['img_header'].'" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>';

        }
       
    echo $html;
   }
}