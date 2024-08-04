<?php
namespace app\models\admin;

use Dee;

class GTupload {
	protected
	$mime_ext_allowed 	= array(
		"gif"	=> array("image/gif"),
		"ico"	=> array("image/x-icon"),
		"jpeg"	=> array("image/jpeg","image/jpg"),
		"jpg"	=> array("image/jpg","image/jpeg"),
        "JPG"	=> array("image/JPG","image/JPEG"),
		"png"	=> array("image/png"),
		"pdf"	=> array("application/pdf"),
		"doc"	=> array("application/msword"),
		"dot"	=> array("application/msword"),
		"docx"	=> array("application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword"),
		"dotx"	=> array("application/vnd.openxmlformats-officedocument.wordprocessingml.template","application/msword"),
		"docm"	=> array("application/vnd.ms-word.document.macroEnabled.12","application/msword"),
		"dotm"	=> array("application/vnd.ms-word.template.macroEnabled.12","application/msword"),
		"xls"	=> array("application/vnd.ms-excel"),
		"xlt"	=> array("application/vnd.ms-excel"),
		"xla"	=> array("application/vnd.ms-excel"),
		"xlsx"	=> array("application/vnd.openxmlformats-officedocument.spreaDIRECTORY_SEPARATORheetml.sheet","application/vnd.ms-excel"),
		"xltx"	=> array("application/vnd.openxmlformats-officedocument.spreaDIRECTORY_SEPARATORheetml.template","application/vnd.ms-excel"),
		"xlsm"	=> array("application/vnd.ms-excel.sheet.macroEnabled.12","application/vnd.ms-excel"),
		"xltm"	=> array("application/vnd.ms-excel.template.macroEnabled.12","application/vnd.ms-excel"),
		"xlam"	=> array("application/vnd.ms-excel.addin.macroEnabled.12","application/vnd.ms-excel"),
		"xlsb"	=> array("application/vnd.ms-excel.sheet.binary.macroEnabled.12","application/vnd.ms-excel"),
		"ppt"	=> array("application/vnd.ms-powerpoint"),
		"pot"	=> array("application/vnd.ms-powerpoint"),
		"pps"	=> array("application/vnd.ms-powerpoint"),
		"ppa"	=> array("application/vnd.ms-powerpoint"),
		"pptx"	=> array("application/vnd.openxmlformats-officedocument.presentationml.presentation","application/vnd.ms-powerpoint"),
		"potx"	=> array("application/vnd.openxmlformats-officedocument.presentationml.template","application/vnd.ms-powerpoint"),
		"ppsx"	=> array("application/vnd.openxmlformats-officedocument.presentationml.slideshow","application/vnd.ms-powerpoint"),
		"ppam"	=> array("application/vnd.ms-powerpoint.addin.macroEnabled.12","application/vnd.ms-powerpoint"),
		"pptm"	=> array("application/vnd.ms-powerpoint.presentation.macroEnabled.12","application/vnd.ms-powerpoint"),
		"potm"	=> array("application/vnd.ms-powerpoint.template.macroEnabled.12","application/vnd.ms-powerpoint"),
		"ppsm"	=> array("application/vnd.ms-powerpoint.slideshow.macroEnabled.12","application/vnd.ms-powerpoint"),
		"3gp"	=> array("video/3gpp"),
		"avi"	=> array("video/x-msvideo"),
		"flv"	=> array("video/x-flv"),
		"mp4"	=> array("video/mp4"),
		"mp3"	=> array("audio/mpeg"),
		"wav"	=> array("audio/wav")
	),
	$extallow 	= "jpg|jpeg|png|gif|pdf|doc|docx|xls|xlsx|ppt|pptx|mp3|mp4|mov|3gp|zip|rar",
	$folder,
	$position 	= array("x"=>"center","y"=>"center"),
	$newsize	= array("width"=>1200,"height"=>630),
	$basename,
	$extension,
	$mime,
	$filename,
    $thumb,
    $widthImg,
    $heightImg,
	$source;
	
	public $result;
	
	private function create_folder( $directory = "" ) {
		$destination	= !empty($directory) ? str_replace(array($this->folder,"/"),array("",DIRECTORY_SEPARATOR),$directory) : NULL;
 		$explodeDir		= !empty($destination) ? explode(DIRECTORY_SEPARATOR,$destination) : array();
		$folder = $this->folder;
		foreach($explodeDir AS $val){
			if(!empty($val)){
				$folder .= $val . DIRECTORY_SEPARATOR;
				if(!file_exists($folder)) {
					mkdir($folder);
				}
			}
		}
		$this->folder = $folder;
		return $this->folder;
	}
	
	public function folder( $directory = "" ){
		$folder	= $this->folder . (!empty($directory) ? str_replace(array($this->folder,"/"),array("",DIRECTORY_SEPARATOR),$directory) . DIRECTORY_SEPARATOR : NULL);
 		if(!is_dir($folder)){
			$folder = $this->create_folder($folder);
		}
		$this->folder = $folder;
		return $this;
	}
	
	public function get_mime($file){
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		$mime = finfo_file($finfo, $file);
		finfo_close($finfo);
		$this->mime = $mime;
		return $this->mime;
	}
	
	public function get_ext($file){
		$extension = strtolower(pathinfo($file,PATHINFO_EXTENSION));
		$this->extension = $extension;
		return $this->extension;
	}
	
	public function source($file){
		if(isset($file['tmp_name'])){
			$imageInfo = getimagesize($file['tmp_name']);
			$this->size($imageInfo[0],$imageInfo[1]);
            $this->widthImg = $imageInfo[0];
            $this->heightImg = $imageInfo[1];
			$this->filename = pathinfo(basename($file['name']),PATHINFO_FILENAME);
			$this->extension= $this->get_ext($file['name']);
			$this->mime 	= $this->get_mime($file['tmp_name']);
			$this->basename	= basename($file['name']);
			$this->source	= $file['tmp_name'];
		} else {
			$this->filename = pathinfo(basename($file),PATHINFO_FILENAME);
			$this->extension= $this->get_ext($file);
			$this->mime 	= $this->get_mime($file);
			$this->basename	= basename($file);
			$this->source   = $file;
		}
		return $this;
	}
	
	public function rename_to($name){
		$this->filename = $name;
		$this->basename = $name . '.' . $this->extension;
		return $this;
	}
	public function thumb($s){
		$this->thumb = $s;
		return $this;
	}
	private function check_allow_file_upload(){
  		$result = FALSE;
		if( in_array($this->extension,explode("|",$this->extallow)) && in_array($this->mime,$this->mime_ext_allowed[$this->extension])){
			$result = TRUE;
		}
		return $result;
	}
	
	public function upload(){
		$result = array(
			'status' 	=> FALSE,
			'messages'	=> 'No file to Upload'
		);
		if( isset($this->source) && !empty($this->source) ){			
			$path 	= $this->folder . $this->filename . "." . $this->extension;
			$url 	= str_replace(array($this->folder,DIRECTORY_SEPARATOR),array($this->folder,"/"), $path);
			$uri	= str_replace($this->folder,'',$url);
			
			$result = array(
				'source'	=> $this->source,
				'filename'  => $this->filename,
				'basename'  => $this->basename, 
				'folder'	=> $this->folder,
				'path' 		=> $path,
				'url' 		=> $url,
				'uri' 		=> $uri
			);
			
			if( $this->check_allow_file_upload() === TRUE ){
				if( is_uploaded_file($this->source) === TRUE ){
					$imageInfo = getimagesize($this->source);
					if(preg_match("/(image)/",$this->mime) && $imageInfo !== FALSE){
						if ( $this->resize() !== FALSE ){
							$this->source = $path;
							$result['status']	= TRUE;
							$result['messages'] = "File has been uploaded";
						} else {
							$result['status']	= TRUE;
							$result['messages'] = "Can't find temp file to move into real path";
						}
					} else {
						if ( move_uploaded_file($this->source, $path) === TRUE ){
							$result['status']	= TRUE;
							$result['messages'] = "File has been uploaded";
						} else {
							$result['status']	= TRUE;
							$result['messages'] = "Can't find temp file to move into real path";
						}
					}
				} else {
					$result['messages'] = "Failed to uploaded file";
				}
			} else {
				$result['messages'] = $this->extension . ' not allowed';
			}	
		}
		$this->result = $result;
		return $this;
	}
	
	public function position($y = "center",$x = "center"){
		$this->position["x"] = $x;
		$this->position["y"] = $y;
		return $this;
	}
	public function size($width = 1200, $height = 630){
		$this->newsize["width"]	= $width;
		$this->newsize["height"]= $height;
		return $this;
	}
	
	private function coordinate($srcWidth,$srcHeight,$newWidth,$newHeight,$crop = FALSE){
		$aspecRatio	= $newWidth / $newHeight;
		$tempHeight = $srcHeight;
		if($crop === TRUE){
			$tempHeight	= ($newHeight > $srcHeight) ? $srcHeight : $newHeight;
		}
		/* menentukan ukuran area crop(pemotongan gambar) pada sumber gambar */
		$cropWidth	= $aspecRatio * $tempHeight; 		/* Mendefinisikan width croping */
		$cropHeight	= (1/$aspecRatio) * $cropWidth; 	/* Mendefinisikan height croping */
		if($cropWidth > $srcWidth){ 					/* Memastikan width croping tidak melebihi sumber gambar (jika melebihi maka lakukan pendefinisian ulang) */
			$cropWidth = $srcWidth; 					/* Mendefinisikan ulang width croping */
			$cropHeight = (1/$aspecRatio) * $cropWidth;	/* Mendefinisikan ulang height croping */
		}
		
		/* 
			Memposisikan koordinat pada sumber gambar, dalam hal ini semisal contoh :
			- sumber gambar berukuran 600x600
			- area croping 400x300
			1.	Dalam posisi 'center center' maka margin left adalah 100 dan margin top adalah 75,
				artinya peng-croping-an dimulai dari koordinat x=100 dan y=75.
			2.	Apabila posisi 'right bottom' maka margin left adalah 200 dan margin top adalah 300,
				artinya peng-croping-an dimulai dari koordinat x=200 dan y=300.
		*/
		
		/* Koordinat sumbu x (horizontal)*/
		if($this->position["x"] == "right"){
			$position_x = $srcWidth - $cropWidth;
		} else if($this->position["x"] == "center") {
			$position_x = ($srcWidth - $cropWidth) > 0 ? ($srcWidth - $cropWidth) / 2 : 0 ;
		} else {
			$position_x = 0;
		}
		
		/* Koordinat sumbu y (vertikal)*/
		if($this->position["y"] == "bottom"){
			$position_y = $srcHeight - $cropHeight;
		} else if($this->position["y"] == "center") {
			$position_y = ($srcHeight - $cropHeight) > 0 ? ($srcHeight - $cropHeight) / 2 : 0 ;
		} else {
			$position_y = 0;
		}
		
		return array(
			"position_x" => $position_x,
			"position_y" => $position_y,
			"newWidth"	 => $newWidth,
			"newHeight"	 => $newHeight,
			"cropWidth"	 => $cropWidth,
			"cropHeight" => $cropHeight,
		);
	}
	
	public function resize($style = FALSE){

		if( $this->extension == "png" ){
			$imgSource	= imagecreatefrompng($this->source);
		} else if( $this->extension == "gif" ) {
			$imgSource	= imagecreatefromgif($this->source);
		} else {
			$imgSource	= imagecreatefromjpeg($this->source);
		}
		
		$srcWidth	= imageSX($imgSource);
		$srcHeight	= imageSY($imgSource);
		$destinationThumb = $this->folder .'thumb/'.$this->filename . '.' . $this->extension;
		$destination= $this->folder . $this->filename . '.' . $this->extension;
		$newWidth	= $this->newsize["width"];
		$newHeight	= $this->newsize["height"];
		$resize		= $this->coordinate($srcWidth,$srcHeight,$newWidth,$newHeight,$style);
		
		$newImage	= imagecreatetruecolor($resize['newWidth'],$resize['newHeight']);
		if( $this->extension == "png" ){
			imagealphablending($newImage, FALSE);
			imagesavealpha($newImage, TRUE);
			imagecopyresampled($newImage ,$imgSource,0,0,$resize['position_x'],$resize['position_y'],$resize['newWidth'],$resize['newHeight'],$resize['cropWidth'],$resize['cropHeight']);
			imagepng($newImage,$destination);
            if($this->thumb != null){
                $layer = $this->resizeImage($imgSource, $this->widthImg, $this->heightImg, $this->thumb, 200);
                imagepng($layer, $destinationThumb);
               }
		} else if ( $this->extension == "gif" ) {
			imagealphablending($newImage, FALSE);
			imagesavealpha($newImage, TRUE);
			imagecopyresampled($newImage ,$imgSource,0,0,$resize['position_x'],$resize['position_y'],$resize['newWidth'],$resize['newHeight'],$resize['cropWidth'],$resize['cropHeight']);
			imagegif($newImage,$destination);
            if($this->thumb != null){
                $layer = $this->resizeImage($imgSource, $this->widthImg, $this->heightImg, $this->thumb, 200);
                imagegif($layer, $destinationThumb);
               }						
		} else {
			imagecopyresampled($newImage ,$imgSource,0,0,$resize['position_x'],$resize['position_y'],$resize['newWidth'],$resize['newHeight'],$resize['cropWidth'],$resize['cropHeight']);
			imagejpeg($newImage ,$destination, 100);
            if($this->thumb != null){
                $layer = $this->resizeImage($imgSource, $this->widthImg, $this->heightImg, $this->thumb, 200);
                imagejpeg($layer, $destinationThumb);
               }
		}
		imagedestroy($imgSource);
		imagedestroy($newImage);
		return TRUE;
	}
    
	function resizeImage($resourceType,$image_width,$image_height, $lebar, $tinggi) 
   {
      $resizeWidth = $lebar;
      $resizeHeight = $tinggi;
      $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
      imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
      return $imageLayer;
    }
}