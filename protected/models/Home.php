<?php

namespace app\models;

use Dee;

class Home
{

   public function __construct(){
	    $this->niw    = Dee::$app->niw;
	   }

	public function get_settings(){

		$data = "SELECT * FROM `setting` WHERE `niw`='". $this->niw ."'";
        return \Dee::$app->db->queryOne($data);

	}
	public function galery(){
		$data = "SELECT * FROM `galery` WHERE `kategori`= '2' AND `status`='0' ORDER BY id DESC limit 3";
		return \Dee::$app->db->queryAll($data);
	}
    public function slide(){
		$data = "SELECT * FROM `galery` WHERE `kategori`= '1' AND `niw`='". $this->niw ."' ORDER BY id DESC limit 5";
		return \Dee::$app->db->queryAll($data);
	}
    public function youtube(){
		$data = "SELECT * FROM `galery` WHERE status = '0' AND `kategori`= '10' ORDER BY RAND() ";
		return \Dee::$app->db->queryAll($data);
	}
    public function kepsek(){
		$data = "SELECT * FROM `galery` WHERE id_album = '1' AND `kategori`= '3' ";
		return \Dee::$app->db->queryOne($data);
	}
    public function artikel(){
		$data 		= "SELECT `a`.*,`c`.`isi` AS `kategori`
						FROM `artikel` AS `a`
						LEFT JOIN `nilai` AS `c` ON `c`.`value_id`=`a`.`category`
                        WHERE `a`.category <> '3'
					    ORDER BY a.id DESC limit 8
		";

		return \Dee::$app->db->queryAll($data);
	}
    public function artikel_lain($ct){
		$query 		= "SELECT `a`.*,`c`.`isi` AS `kategori`
						FROM `artikel` AS `a`
						LEFT JOIN `nilai` AS `c` ON `c`.`value_id`=`a`.`category`
					    WHERE `a`.category = '".$ct."' AND `a`.`niw`='". $this->niw ."' ORDER BY a.data_id DESC limit 5
		";
    	return \Dee::$app->db->queryAll($query);
	}

  public function berita(){
		$query 		= "SELECT `a`.*,`c`.`isi` AS `kategori`
						FROM `artikel` AS `a`
						LEFT JOIN `nilai` AS `c` ON `c`.`value_id`=`a`.`category`
					    WHERE `a`.`niw`='". $this->niw ."' ORDER BY a.id DESC limit 5
		";
    	return \Dee::$app->db->queryAll($query);
	}

    public function lihat_value($val){

		$data = "SELECT * FROM `nilai` WHERE `thekey`= '".$val."' AND `niw`= '".$this->niw."'";
	    return \Dee::$app->db->queryAll($data);
	}
  public function info(){
        $date = date('Y-m-d');
		$data = "SELECT * FROM `agenda` WHERE tgl_pelaksanaan >= '".$date."' ORDER BY tgl_pelaksanaan DESC " ;
	    return \Dee::$app->db->queryAll($data);
	}
  
}
