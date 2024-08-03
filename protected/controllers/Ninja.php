<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;
/**
 * Description of SiteController
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
 
class Ninja extends Controller {


	public function actionIndex(){
	       
       	return $this->render("ninja");
   		
	}
}