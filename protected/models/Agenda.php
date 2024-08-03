<?php
namespace app\models;

use Dee;

class Agenda
 {

    public function __construct(){
	    $this->niw    = Dee::$app->niw;
	   }

	public function agenda(){

		$pagination = new \app\models\Pagination();
        //HALAMAN
        if(isset($_GET['hal'])) $segment2 = $_GET['hal'];
        //PENCARIAN
        if(isset($_GET['q'])){$q = $_GET['q']; $c = "WHERE tema LIKE '%$q%'";} else{ $c = '';}

		$page = isset($segment2) && !empty($segment2) ? (int)$segment2 : 1;

        $sql	= "SELECT * FROM `agenda` $c ORDER BY tgl_pelaksanaan DESC ";
        
        $query = \Dee::$app->db->queryAll($sql);

		$pagination->total = count($query);
		$pagination->page = !empty($page) ? (int)$page : 1;
		$pagination->limit = 6;
		$pagination->url =  Dee::createUrl('agenda?hal=').'';
		$start = ($pagination->page - 1) * $pagination->limit;
		$limit = " LIMIT " . $start . "," . $pagination->limit . ";";
		$dataa = \Dee::$app->db->queryAll($sql . $limit);

		$date = new \app\models\Date();
		$data = array();
		foreach($dataa AS $item){
			$item['date'] = $date->indonesia($item['tgl_pelaksanaan'],"l, d F Y");
			$item['title'] = $item['tema'];
			$data[] = $item;
		}
		$result['lists'] = $data;
		$result['pagination'] = $pagination->render();
       	return $result;
	}

    public function artikel(){

        $query	= "
			SELECT `art`.*, `v`.`isi` AS `isi`
			FROM `artikel` AS `art`
			LEFT JOIN `nilai` AS `v` ON `v`.`value_id`=`art`.`category`
			ORDER BY `art`.`views` ASC limit 6
            ";
		$data = \Dee::$app->db->queryAll($query);
		return $data;
	}
   
   
  public function get_baca($id){

		$query = "SELECT * FROM `agenda` WHERE `agenda_id`= '".$id."'";
        $dat = \Dee::$app->db->queryOne($query);
        if(!empty($dat)){
         $data = $dat;
        $up['views'] = $data['views']+2;
        \Dee::$app->db->update('agenda', $up, ['agenda_id' => $data['agenda_id']]);
        }else{
          $data = null;
        }
        return $data;
	}
 

}
