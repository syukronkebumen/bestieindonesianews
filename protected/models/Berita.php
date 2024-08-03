<?php
namespace app\models;
use Dee;
class Berita
 {

   public function __construct(){
	    $this->niw    = Dee::$app->niw;
	   }


	public function berita(){

		$pagination = new \app\models\Pagination();
        //HALAMAN
        if(isset($_GET['hal'])) $segment2 = $_GET['hal'];
        //PENCARIAN
        $q = (isset($_GET['q']))? $_GET['q'] : null ; 
       

		$page = isset($segment2) && !empty($segment2) ? (int)$segment2 : 1;
        if(isset($q) && $q != null ){
        $sql	= "
			SELECT `art`.*, v.isi AS isi
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			WHERE art.title LIKE '%$q%' 
            ORDER BY art.id DESC
		";
        }else{
        $sql	= "
			SELECT `art`.*, v.isi AS isi
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
		    ORDER BY art.id DESC
		";
        }
        $query = \Dee::$app->db->queryAll($sql);

		$pagination->total = count($query);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 6;
		$pagination->url =  Dee::createUrl('post?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($sql . $limit);

		$date = new \app\models\Date();
		$data = array();
		foreach($dataa AS $item){
			$item['date'] = $date->indonesia($item['date'],"l, d F Y");
			$item['title'] = $item['title'];
			$data[] = $item;
		}
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
       	return $result;
	}
    public function populer($cate =''){

        $segment2 = $cate;
        $cat = isset($segment2) && !empty($segment2) ? $segment2 : 'headline';
	    $sql	= "
			SELECT `art`.*
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			ORDER BY id DESC LIMIT 5
		";
		$data = \Dee::$app->db->queryAll($sql);
		return $data;
	}

	public function category($cate=''){

		$pagination = new \app\models\Pagination();
        if(isset($_GET['hal'])){ $segment3 = $_GET['hal']; }
		$segment2 = $cate;
        //$segment3 = $this->route->segment(4);
        $cat = isset($segment2) && !empty($segment2) ? $segment2 : 'berita';
		$page = isset($segment3) && !empty($segment3) ? (int)$segment3 : 1;

        $query	= "
			SELECT `art`.*,v.isi as isi
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			WHERE `v`.`isi`='".$cat."' AND `art`.`niw`='".$this->niw."'
             ORDER BY art.id DESC
		";
		$sql = \Dee::$app->db->queryAll($query);
		$pagination->total = count($sql);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 6;
		$pagination->url =  Dee::createUrl("category/".$cat."?hal=");
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($query . $limit);

		$date = new \app\models\Date();
		$data = array();
		foreach($dataa AS $item){
			$item['date'] = $date->indonesia($item['date'],"d M Y");
			$item['title'] = $item['title'];
			$data[] = $item;
		}
		$result['lists'] = $data;
        $result['nav'] = $cat;
		$result['pagination'] = $pagination->render();
		return $result;
	}
    
    	public function kinerja(){

		$pagination = new \app\models\Pagination();
        if(isset($_GET['hal'])){
            $segment3 = $_GET['hal'];
        }
			$page = isset($segment3) && !empty($segment3) ? (int)$segment3 : 1;

        $query	= "
			SELECT `art`.*,v.isi as isi
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			WHERE `art`.`category`= '3' 
            ORDER BY art.id DESC
		";
		$sql = \Dee::$app->db->queryAll($query);
		$pagination->total = count($sql);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 9;
		$pagination->url =  Dee::createUrl("kinerja?hal=");
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($query . $limit);

		$date = new \app\models\Date();
		$data = array();
		foreach($dataa AS $item){
			$item['date'] = $date->indonesia($item['date'],"d M Y");
			$item['title'] = $item['title'];
			$data[] = $item;
		}
		$result['kinerja'] = $data;
        $result['nav'] = 'Gallery Kinerja OPD';
		$result['pagination'] = $pagination->render();
		return $result;
	}
  public function crime(){
		$pagination = new \app\models\Pagination();
        //HALAMAN
        if(isset($_GET['hal'])) $segment2 = $_GET['hal'];
        //PENCARIAN
        if(isset($_POST['q'])){$q = $_POST['q']; $c = "WHERE art.title LIKE '%$q%'";} else{ $c = '';}

		$page = isset($segment2) && !empty($segment2) ? (int)$segment2 : 1;
        $sqla = "SELECT * FROM `polres` ".$c." ORDER BY id DESC";
       $sql	= "
			SELECT `art`.*
			FROM `polres` AS `art`
			$c
            ORDER BY art.id DESC
		";
        $query = \Dee::$app->db->queryAll($sql);

		$pagination->total = count($query);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 10;
		$pagination->url =  Dee::createUrl('crime?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = "LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($sql . $limit);

		$date = new \app\models\Date();
		$data = array();
		foreach($dataa AS $item){
			$item['date'] = $date->indonesia($item['date'],"l, d F Y");
			$item['title'] = $item['title'];
			$data[] = $item;
		}
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
       	return $result;
	}
}
