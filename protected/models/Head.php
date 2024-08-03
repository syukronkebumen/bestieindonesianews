<?php 
namespace app\models;

use Dee;

class Head 
{
   
    public function __construct(){
	    $this->niw    = Dee::$app->niw; 
	   }
	public function get_settings(){
	    $date                = new \app\models\Date();
        $item['web'] =  \Dee::$app->db->queryOne("SELECT * FROM `setting` WHERE `niw`='". $this->niw ."'");
	    $item['artikel'] = \Dee::$app->db->queryAll("SELECT * FROM `artikel` WHERE `niw`= '".$this->niw."' ORDER BY id DESC limit 6");
        $item['category'] = \Dee::$app->db->queryAll("SELECT * FROM `nilai` WHERE `thekey`= 'artikel' AND `niw`= '".$this->niw."'");
        $item['menu'] = \Dee::$app->db->queryAll("SELECT * FROM `nilai` WHERE `thekey`= 'menu' AND `niw`= '".$this->niw."'");
        $item['child'] = \Dee::$app->db->queryAll("SELECT * FROM `pages` WHERE `niw`= '".$this->niw."'");
        $item['hari_ini'] = $date->indonesia(date("Y-m-d"),"l, d F Y");
        $data['ip'] = $this->getUserIP();
        $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        $data['session_id'] = session_id();
        $data['niw'] = $this->niw;
        \Dee::$app->db->insert("visitors",$data);
  		return $item;
	}
	public function get_footer(){
        $item['web'] =  \Dee::$app->db->queryOne("SELECT * FROM `setting` WHERE `niw`='". $this->niw ."'");
	    $item['category'] = \Dee::$app->db->queryAll("SELECT * FROM `nilai` WHERE `thekey`= 'artikel' AND `niw`= '".$this->niw."'");
        $item['portofolio'] = \Dee::$app->db->queryAll("SELECT * FROM `pages` WHERE `niw`= '".$this->niw."'");
        $item['musik'] = \Dee::$app->db->queryAll("SELECT * FROM `galery` WHERE `kategori`= '6' AND status= '0' ORDER BY id ASC limit 1");
    	$item['link'] = \Dee::$app->db->queryAll("SELECT * FROM `galery` WHERE `kategori`= '7' ORDER BY id ASC");
        $item['tamu'] = $this->get_visitors();
        return $item;
	}
    public function get_visitors(){
		
		$today	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE YEAR(`date_time`)=YEAR(CURDATE())   AND MONTH(`date_time`)=MONTH(CURDATE()) AND DATE(`date_time`)=CURDATE() "));
		$week	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE YEAR(`date_time`)=YEAR(CURDATE())   AND MONTH(`date_time`)=MONTH(CURDATE()) AND WEEK(`date_time`)=WEEK(CURDATE())"));
		$month	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE YEAR(`date_time`)=YEAR(CURDATE())   AND MONTH(`date_time`)=MONTH(CURDATE())"));
		$total 	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` "));
		return array(
			"today"		=> $today,
			"week"		=> $week,
			"month"		=> $month,
			"total"		=> $total,
		);
	}
    
    function getUserIP(){
	$client  = @$_SERVER['HTTP_CLIENT_IP'];
	$forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
	$remote  = $_SERVER['REMOTE_ADDR'];
	if(filter_var($client, FILTER_VALIDATE_IP)){
		$ip = $client;
	}elseif(filter_var($forward, FILTER_VALIDATE_IP)){
		$ip = $forward;
	}else{
		$ip = $remote;
	}
	return $ip;
}
}