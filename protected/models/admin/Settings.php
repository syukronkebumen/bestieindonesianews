<?php
namespace app\models\admin;
use Dee;

class Settings
 {
    public function __construct(){
	  $this->niw    = Dee::$app->niw; 
       	}
    
	public function data(){
		
		$sql = "SELECT * FROM `setting` WHERE `niw`='". $this->niw ."'";
        return \Dee::$app->db->queryOne($sql);
	}
	
    
	public function update(){
		$response['status']		= "error";
		$response['message']	= "Please check your input";
        
		if(isset($_POST["pk"])){
			$setting_id 	= $_POST["pk"];
            $colums 	    =  $_POST["name"];
			if($setting_id ){
				$data[$colums] 	= preg_replace('~[\r\n\t]+~', '', $_POST["value"]);
			} else {
				$data[$colums] = $_POST["value"];
			}
		   $updated = \Dee::$app->db->update('setting', $data, ['id' => $setting_id]);
           
			if(isset($updated)){
				$response['status'] = "success";
				$response['message'] = "Data has been save";
				$response['redirect'] = "settings";
			} else {
				$response['status'] = "error";
				$response['message'] = "Data couldn't save";
			}
		}
		return $response;
	}
       
    function directorymap(string $sourceDir, int $directoryDepth = 0, bool $hidden = false): array
	{
		try
		{
			$fp = opendir($sourceDir);

			$fileData  = [];
			$newDepth  = $directoryDepth - 1;
			$sourceDir = rtrim($sourceDir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

			while (false !== ($file = readdir($fp)))
			{
				// Remove '.', '..', and hidden files [optional]
				if ($file === '.' || $file === '..' || $file === 'erorr.php' || $file === 'admin' || ($hidden === false && $file[0] === '.'))
				{
					continue;
				}

				is_dir($sourceDir . $file) && $file .= '';

				if (($directoryDepth < 1 || $newDepth > 0) && is_dir($sourceDir . $file))
				{
					$fileData[$file] = directorymap($sourceDir . $file, $newDepth, $hidden);
				}
				else
				{
					$fileData[] = $file;
				}
			}

			closedir($fp);
			return $fileData;
		}
		catch (Throwable $e)
		{
			return [];
		}
	}
}
