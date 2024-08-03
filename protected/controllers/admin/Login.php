<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Login extends Controller
 {

   
    
	public function __construct(){
	 if(isset(Dee::$app->user->id))Dee::redirect('admin/dashboard');
     $this->niw    = Dee::$app->niw; 
       	}

   
	public function actionIndex(){
	    $_SESSION["captcha"] = simple_php_captcha();
		$modelsettings = new \app\models\admin\Settings();
        $data = $modelsettings->data();
		$html = $this->render("admin/login",$data);
		return $html;
	}
	public function actionCheck(){
		$result 	= "false";
		$username 	= preg_replace('/[^a-zA-Z0-9\_]/mi','',$_POST['username']);
      	$sql = "SELECT `id` FROM `users` WHERE `username`='". $username ."' ";
        $data = \Dee::$app->db->queryAll($sql);
     	if(count($data) > 0){
			$result = "true";
		}
		
		return $result;
	}
	public function actionSignIn(){
	   
		$response['status'] = "error";
		$response['message'] = "Please check your input";
        $hash = new \app\models\admin\PasswordHash(8, TRUE);
  
  		if(isset($_POST['submit'])){
			if( $_SESSION['captcha']['code'] == $_POST['captcha']){
			$username = preg_replace('/[^a-zA-Z0-9\_]/mi','',$_POST['username']);
			$password = trim($_POST['password']);
			$sql = "SELECT `id`,`password`,`valid` FROM `users` WHERE `username`='". $username ."' ";
         	
				$admin = \Dee::$app->db->queryOne($sql);
				if ($hash->CheckPassword($password, $admin['password'])) {
					
                    if ($admin['valid'] == '1') {
                        Dee::$app->user->login($admin['id']);
                        
						$response['status'] = "success";
						$response['message'] = "Tunggu Sebentar ......";
						$response['redirect'] =  Dee::createUrl("admin/berita");
					}else{
				    	$response['message'] = "Akun anda tidak aktif, silahkan hubungi admin";	
					}
				} elseif(md5($password) == $admin['password']) {
				    
                    if ($admin['valid'] == '1') {
                        Dee::$app->user->login($admin['id']);
                        $da['password'] = $hash->HashPassword($password);
				        \Dee::$app->db->update('users', $da , ['id' => $admin['id']]); 
                        
						$response['status'] = "success";
						$response['message'] = "Tunggu Sebentar ......";
						$response['redirect'] =  Dee::createUrl("admin/berita");
					}else{
				    	$response['message'] = "Akun anda tidak aktif, silahkan hubungi admin";	
					}
                } else {
				    $response['message'] = "Password Anda Salah ";
				}
			
		} else {
				$response['message'] = "Kode captcha tidak sama";
			}
        }
		Dee::$app->response->format = "json";
		return $response;
	}
    
 	public function actionSignIn_Bak(){
	   
		$response['status'] = "error";
		$response['message'] = "Please check your input";
        $hash = new \app\models\admin\PasswordHash(8, TRUE);
  
  		if(isset($_POST['submit'])){
			if( $_SESSION['captcha']['code'] == $_POST['captcha']){
			$username = preg_replace('/[^a-zA-Z0-9\_]/mi','',$_POST['username']);
			$password = trim($_POST['password']);
			$sql = "SELECT `id`,`password`,`valid` FROM `users` WHERE `username`='". $username ."' ";
            
			$data = \Dee::$app->db->queryAll($sql);
     	    if(count($data) > 0){
				$admin = \Dee::$app->db->queryOne($sql);
				if (password_verify($password, $admin['password'])) {
					
                    if ($admin['valid'] == '1') {
                        Dee::$app->user->login($admin['id']);
                        
						$response['status'] = "success";
						$response['message'] = "Tunggu Sebentar ......";
						$response['redirect'] =  Dee::createUrl("admin/dashboard");
					}else{
				    	$response['message'] = "Akun anda tidak aktif, silahkan hubungi admin";	
					}
				} elseif($hash->CheckPassword($password, $admin['password'])) {
				    if ($admin['valid'] == '1') {
                        Dee::$app->user->login($admin['id']);
                        $da['password'] = $this->password($password);
				        \Dee::$app->db->update('users', $da , ['id' => $admin['id']]); 
                        
						$response['status'] = "success";
						$response['message'] = "Tunggu Sebentar ......";
						$response['redirect'] =  Dee::createUrl("admin/dashboard");
					}else{
				    	$response['message'] = "Akun anda tidak aktif, silahkan hubungi admin";	
					}
                } else {
				    $response['message'] = "Password Anda Salah ";
				}
			} else {
				$response['message'] = "Anda tidak terdaftar";
			}
		} else {
				$response['message'] = "Kode captcha tidak sama";
			}
        }
		Dee::$app->response->format = "json";
		return $response;
	}
 
 
    public function password($text){
		$timeTarget = 0.05;
		$cost = 8;
		$pass;
		do {
		    $cost++;
		    $start = microtime(true);
		    $pass = password_hash($text, PASSWORD_BCRYPT, ["cost" => $cost]);
		    $end = microtime(true);
		} while (($end - $start) < $timeTarget);

		return $pass;
	}
    
}