<?php
namespace app\controllers;

use dee\base\Controller;

use Dee;

class Kinerja extends Controller
{
    private $model;


    public function __construct(){
	 if(!isset(Dee::$app->user->id))Dee::redirect('admin');
     $this->model =  new \app\models\admin\Berita();
	}

	public function actionIndex(){


        $head =  new \app\models\admin\Dashboard();
        $head     = $head->header();
        $head['is_active'] = 'kinerja';
       	$html = $this->render("admin/parts/header",$head);

		$breadcrumbs['title'] = 'Data kinerja';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Daftar Data', 'is_active'=>TRUE)
		);
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);

        $table['table_url'] 		    =  Dee::createUrl('/admin/kinerja/get-all');
		$table['title'] 				= 'Data kinerja';
		$table['add_url'] 				=  Dee::createUrl('admin/kinerja/form');
		$table['delete_url']			=  Dee::createUrl('admin/kinerja/delete');
		$html .= $this->render("admin/berita/datatable",$table);
		$html .= $this->render("admin/parts/footer");
		return $html;
	}

    public function actionGetAll(){
        $result         = $this->model->getAllKinerja();
        $data['data'] = array();
        foreach ($result as $key => $value) {
            $Image = isset($value['img_header']) && is_file(Dee::$app->basePathe.'/uploads/artikel/thumb/' . $value['img_header']) ? Dee::$app->baseUrl.'/public/uploads/artikel/thumb/' . $value['img_header'] : Dee::$app->baseUrl .'/public/assets/images/no-image/poster.jpg';
         	$title   = substr($value['title'],0,50);
            $val     = $value['isi'];
            $foto    = '<img src="'.$Image.'" width="80" />';
			$ops = '<div class="btn-group">';
			$ops .= '	<a href="'. Dee::createUrl('admin/kinerja/form?id={id}', ['id'=>$value['id']]).'" type="button" class="btn btn-sm btn-outline-primary" ><i class="fa fa-edit"></i> Edit</a>';
			$ops .= "	<button type='button'  onclick='remove(\"".$value['id']."\",\"".Dee::createUrl('admin/kinerja/delete')."\")' class='btn btn-sm btn-outline-primary' ><i class='fa fa-trash'></i>Hapus</button>";
			$ops .= '</div>';

			$data['data'][$key] = array(
				$title,
                $val,
				$foto,
				$ops,
			);
		}
        Dee::$app->response->format = "json";
		return $data;
	}

	public function actionForm(){
		$head =  new \app\models\admin\Dashboard();
        $head     = $head->header();
        $head['is_active'] = 'kinerja';
       	$html = $this->render("admin/parts/header",$head);
      
		$breadcrumbs['title'] = 'Edit kinerja';
		$breadcrumbs['breadcrumbs'] = array(
			array('title'=>'Beranda', 'href'=>'admin/dashboard'),
			array('title'=>'Data kinerja', 'href'=>'admin/kinerja'),
			array('title'=>'Edit', 'is_active'=>TRUE)
		);
		$html .= $this->render("admin/parts/breadcrumbs",$breadcrumbs);

		$form['title']		 		= "Form kinerja";
		$form['action_url'] 		= Dee::createUrl('admin/kinerja/simpan')  ;
		$form['category']           = $this->actionSelectAccess();
        $form['delete_url']			= Dee::createUrl('admin/value/delete');

        if(isset($_GET['id'])){
          $admin_id 	= $_GET['id'];

		  $sql 	  =  "SELECT `art`.*, `vaa`.`isi` AS `cat`
			         FROM `artikel` AS `art`
			         LEFT JOIN `nilai` AS `vaa` ON `vaa`.`value_id`=`art`.`category`
			         WHERE `art`.`id`='". $admin_id ."'
			         ";
        $form['artikel'] = \Dee::$app->db->queryOne($sql);
        }
		$html .= $this->render("admin/berita/form-kinerja",$form);
		$html .= $this->render("admin/parts/footer");
		return $html;

	}

	public function actionSelectAccess(){
	   $sql 		= "SELECT * FROM `nilai` WHERE `thekey`='kerja' AND `niw`='".Dee::$app->niw."' ORDER BY value_id DESC";
	    //Dee::$app->response->format = "json";
		return \Dee::$app->db->queryAll($sql);
	}

	public function actionSimpan(){
		Dee::$app->response->format = "json";
		return $this->model->simpan();
	}

	public function actionValue(){
		return $this->load->controller('kinerja/value',NULL,$this->route->segment(3));
	}

	public function actionDelete(){
		Dee::$app->response->format = "json";
		return $this->model->delete();
	}


    public function actionUploadImage(){
        $uploader = new \app\models\admin\Uploader();
     	$uploader->setExtensions(array('jpg','jpeg','png','gif','doc','docx'));
        $uploader->setMaxSize(5);
        $uploader->setDir(Dee::$app->basePathe.'/uploads/artikel/');
        //$uploader->getThumb(150);
        $uploader->reSize(750,0);
            if($uploader->uploadFile('image'))
                {$data  =   $uploader->getUploadName();}
        echo  Dee::$app->baseUrl.'/public/uploads/artikel/'. $data;

    }
 function delete_image(){
    $src = $this->input->post('src');
    $file_name = str_replace(Dee::$app->baseUrl, '', $src);
    if(unlink($file_name)){
        echo 'File Delete Successfully';
    }
}
}
