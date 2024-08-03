<?php
namespace app\models;
class Date {
	private 
	$format = "Y-m-d",
	$en = array('January','February','March','May','June','July','August','October','December','Aug','Oct','Dec','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'),
	$id = array('Januari','Februari','Maret','Mei','Juni','Juli','Agustus','Oktober','Desember','Agu','Okt','Dec','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
	
	private function format($format){
		if(!empty($format)){
			$this->format = $format;
		}
		return $this;
	}
	
	private function totime($str){
		return strtotime(str_replace($this->id,$this->en,$str));
	}
	
	public function english($date,$format = "Y-m-d"){
		$this->format($format);
		return date($this->format,$this->totime($date));
	}
	
	public function indonesia($date,$format = "Y-m-d"){
		$this->format($format);
		return str_replace($this->en,$this->id, date($this->format,$this->totime($date)));
	}
}
