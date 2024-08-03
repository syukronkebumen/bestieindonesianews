<?php 
namespace app\models\admin;
use Dee;


class Dashboard
  {
    public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
    
	public function folderSize($dir){
		$size = 0;
		foreach (glob(rtrim($dir, '/').'/*', GLOB_NOSORT) as $each) {
			$size += is_file($each) ? filesize($each) : $this->folderSize($each);
		}
		return $size;
	}
	public function prettySize($size = 0){
		$units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
		$power = $size > 0 ? floor(log($size, 1000)) : 0;
		return number_format($size / pow(1000, $power), 2, '.', ',') . ' ' . $units[$power];
	}

	public function get_diskspace(){
		
		$diskspace	= $this->folderSize(Dee::$app->basePathe);
		
		$q = \Dee::$app->db->queryAll("SHOW TABLE STATUS"); 
		$size = 0;  
		foreach($q AS $row) {  
			$size += $row["Data_length"] + $row["Index_length"];  
		}
		$mysql_size = $size;

		$packages			= 1000000000;
		$total_diskspace 	= $diskspace + $mysql_size;
		$persentage 		= ($total_diskspace/$packages) * 100;

		return array(
			"app_size"			=> $this->prettySize($diskspace),
			"mysql_size"		=> $this->prettySize($mysql_size),
			"title"				=> $this->prettySize($total_diskspace) . " of " .  $this->prettySize($packages),
			"total_size" 	=> $this->prettySize($total_diskspace),
			"persentage" 		=> $persentage
		);
	}

	public function get_visitors(){
		
		$today	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE DATE(`date_time`)=CURDATE() AND `niw`='". $this->niw ."' "));
		$week	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE YEAR(`date_time`)=YEAR(CURDATE()) AND `niw`='". $this->niw ."' AND WEEK(`date_time`)=WEEK(CURDATE())"));
		$month	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE YEAR(`date_time`)=YEAR(CURDATE()) AND `niw`='". $this->niw ."' AND MONTH(`date_time`)=MONTH(CURDATE())"));
		$total 	= count(\Dee::$app->db->queryAll("SELECT `id` FROM `visitors` WHERE `niw`='". $this->niw ."'"));
		return array(
			"today"		=> $today,
			"week"		=> $week,
			"month"		=> $month,
			"total"		=> $total,
		);
	}
    public function header(){
		
		$data = $this->settings();
		$data['title'] = $data['instansi'];
		$data['showtitle'] = $data['instansi'];
		$author = $this->getview();
		$data['nama'] = $author['fullname'];
		$data['image'] = $author['image'];
		return $data;
	}
    public function getview(){
	   
		$id = isset(Dee::$app->user->id) ? Dee::$app->user->id : NULL;
        $sql = "SELECT * FROM `users` AS `u`  WHERE `u`.`id`='".$id."' AND `niw`='". $this->niw ."' ";
		return \Dee::$app->db->queryOne($sql);;
	}
    
    public function settings(){
		
		$sql = "SELECT * FROM `setting` WHERE `niw`='". $this->niw ."'";
        return \Dee::$app->db->queryOne($sql);
	}
}