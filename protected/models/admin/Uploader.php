<?php
namespace app\models\admin;

use Dee;

class Uploader
{
    private $destinationPath;
    private $errorMessage;
    private $extensions;
    private $maxSize;
    private $lebar;
    private $tinggi;
    private $thumb;
    private $thumbTinggi;
    private $uploadName;
    private $reName;
    public  $name='Uploader';

    function setDir($path){
        $this->destinationPath  =   $path;
    }

    function setMaxSize($sizeMB){
        $this->maxSize  =   $sizeMB * (1024*1024);
    }

    function setExtensions($options){
        $this->extensions   =   $options;
    }

    function setMessage($message){
        $this->errorMessage =   $message;
    }

    function getMessage(){
        return $this->errorMessage;
    }

    function getUploadName(){
            return $this->uploadName;
    }
    function reName(){
            return $this->reName;
    }
    function reSize($lebar, $tinggi){
        $this->lebar  =   $lebar;
       
    }
    function getThumb($i){
           $this->thumb = $i ;
    }
    
    function uploadFile($fileBrowse){
        $result =   false;

        $size   =   $_FILES[$fileBrowse]["size"];
        $name   =   $_FILES[$fileBrowse]["name"];
        $fileName = $_FILES[$fileBrowse]["tmp_name"];
        $ext    =   pathinfo($_FILES[$fileBrowse]["name"], PATHINFO_EXTENSION);
        $this->reName =   date('Ymd-His');
        $sourceProperties = getimagesize($_FILES[$fileBrowse]["tmp_name"]);
        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        if($this->lebar != null)
       {
            $ombo = $sourceImageWidth/$this->lebar;
            $this->tinggi = $sourceImageHeight/$ombo;
            $this->uploadName =  $this->reName . '.' . $ext;
        }else{
        	$this->lebar = $sourceImageWidth;
         	$this->tinggi = $sourceImageHeight;
        	$this->uploadName =  $name;
        }
       if($this->thumb != null)
       {
            $ombo = $sourceImageWidth/$this->thumb;
            $this->thumbTinggi = $sourceImageHeight/$ombo;
           
        }



        if(empty($name))
        {
            $this->setMessage("File not selected ");
        }
        else if($size > $this->maxSize)
        {
            $this->setMessage("Too large file !");
        }
        else if(in_array($ext,$this->extensions))
        {

            if(file_exists($this->destinationPath . $this->uploadName))
                $this->setMessage("File already exists. !");
            else if(!is_writable($this->destinationPath))
                $this->setMessage("Destination is not writable !");
            else
            {
       if($this->lebar != null || $this->tinggi != NULL)
       {
        switch ($uploadImageType) {
            case IMAGETYPE_JPEG:
                $resourceType = imagecreatefromjpeg($fileName);
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight, $this->lebar, $this->tinggi);
                imagejpeg($imageLayer, $this->destinationPath . $this->uploadName);
                if($this->thumb != null){
                $resource = imagecreatefromjpeg($fileName);
                $layer = $this->resizeImage($resource,$sourceImageWidth,$sourceImageHeight, $this->thumb, $this->thumbTinggi);
                imagejpeg($layer, $this->destinationPath ."thumb/". $this->uploadName);
               }
                break;

            case IMAGETYPE_GIF:
                $resourceType = imagecreatefromgif($fileName);
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight, $this->lebar, $this->tinggi);
                imagegif($imageLayer,$this->destinationPath . $this->uploadName);

                if($this->thumb != null){
                $resource = imagecreatefromgif($fileName);
                $layer = $this->resizeImage($resource,$sourceImageWidth,$sourceImageHeight, $this->thumb, $this->thumbTinggi);
                imagegif($layer, $this->destinationPath ."thumb/". $this->uploadName);
               }
                break;

            case IMAGETYPE_PNG:
                $resourceType = imagecreatefrompng($fileName);
                $imageLayer = $this->resizeImage($resourceType,$sourceImageWidth,$sourceImageHeight, $this->lebar, $this->tinggi );
                imagepng($imageLayer,$this->destinationPath . $this->uploadName);

                if($this->thumb != null){
                $resource = imagecreatefrompng($fileName);
                $layer = $this->resizeImage($resource,$sourceImageWidth,$sourceImageHeight, $this->thumb, $this->thumbTinggi);
                imagepng($layer, $this->destinationPath ."thumb/". $this->uploadName);
               }
                break;

            default:
                $imageProcess = 0;
                break;
        }
        }

                if(move_uploaded_file($_FILES[$fileBrowse]["tmp_name"],$this->destinationPath . $name))

                {
                  $result =   true;
                    if( $this->uploadName <>  $name )  {
                        //$this->deleteUploaded($fileBrowse);
                        $this->webpImage($fileBrowse, $this->destinationPath . $this->uploadName, 80, true);
                    }
                }
                else
                {
                    $this->setMessage("Upload failed , try later !");
                }
            }
        }
        else
        {
            $this->setMessage("Invalid file format !");
        }
        return $result;
    }


  function resizeImage($resourceType,$image_width,$image_height, $lebar, $tinggi)
   {
      $resizeWidth = $lebar;
      $resizeHeight = $tinggi;
      $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
      imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
      return $imageLayer;
    }

  function deleteUploaded($fileBrowse){
        $name   =   $_FILES[$fileBrowse]["name"];
        $ext    =   pathinfo($name,PATHINFO_EXTENSION);
        unlink($this->destinationPath . $name);
    }
    
  function webpImage($fileBrowse, $source, $quality = 100, $removeOld = true)
    {
        $nama   =   $_FILES[$fileBrowse]["name"];
        $dir = pathinfo($source, PATHINFO_DIRNAME);
        $name = pathinfo($source, PATHINFO_FILENAME);
        $destination = $dir . DIRECTORY_SEPARATOR . $name . '.webp';
        $info = getimagesize($source);
        $isAlpha = false;
        if ($info['mime'] == 'image/jpeg')
            $image = imagecreatefromjpeg($source);
        elseif ($isAlpha = $info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($isAlpha = $info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return $source;
        }
        if ($isAlpha) {
            imagepalettetotruecolor($image);
            imagealphablending($image, true);
            imagesavealpha($image, true);
        }
        imagewebp($image, $destination, $quality);

        if ($removeOld)
            unlink($this->destinationPath . $nama);

        return $name;
    }
}


?>
