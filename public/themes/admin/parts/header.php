<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"><meta http-equiv="X-UA-Compatible" content="IE=edge"><meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo $title;?></title>
		<base href="<?php echo Dee::$app->baseUrl;?>" />

        <link rel="shortcut icon" href="<?= Dee::$app->baseUrl ?>/favicon.ico" />
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/vendor.css">
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/plugins.css">
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/toastr.min.css">
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/toastr-custom.css">
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/main.css">
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/custom.css">

		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/bootstrap-tagsinput.css"/>
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/bootstrap-editable.css"/>
		<link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>backend/nestable.css"/>
        <link rel="stylesheet" href="<?php echo Dee::$app->baseUrl.'/public/assets/css/';?>sweetalert2.css"/>

        <script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/vendor.js"></script>
        <script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/plugins.js"></script>
        <script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/main.js"></script>
		<script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend.js"></script>

        <script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/toastr.min.js"></script>
		<script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/multicheckbox.js"></script>
		<script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/nestable.js"></script>
		<script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/bootstrap-tagsinput.js"></script>
		<script src="<?php echo Dee::$app->baseUrl.'/public/assets/js/';?>backend/bootstrap-editable.js"></script>
	    <style>label{font-weight: 700;}</style>
    </head>
	<body>
    <?php $icon = isset($logo) && is_file(Dee::$app->basePathe.'/uploads' . '/' . $logo) ? 	Dee::$app->baseUrl.'/public/uploads/BI-putih.png' : Dee::$app->baseUrl .'/public/assets/images/logo.png';	?>
		<div class="preloader-wrapper">
	        <div class="preloader">
	            <img src="<?php echo Dee::$app->baseUrl .'/public/assets/images/ring.gif';?>" alt="Logo">
	        </div>
	    </div>
	    <main>
	        <section class="body-admin">
	            <header>
	                <div class="main-header">
	                    <div class="left">
	                        <div class="mobile-icon">
	                            <div class="menu-opener">
	                              <div class="menu-opener-inner"></div>
	                            </div>
	                        </div>
	                        <div class="logo">
	                            <img src="<?php echo $icon; ?>" alt="Logo">
	                          <!---  <h1><?= $instansi ?></h1> -->
	                        </div>
	                        <button class="mobile-icon-right">
	                            <i class="fas fa-ellipsis-v"></i>
	                        </button>
	                    </div>
	                    <div class="right">
	                        <button class="btn btn-hide-aside" id="btn-hide-aside"><i class="fas fa-align-left"></i></button>
	                        <div class="menu">
	                            <ul>

	                                <li>
	                                    <a href="#" class="dropdown-toggle dropdown-menu-right" type="button" data-toggle="dropdown"><div class="avatar"><img src="<?php echo isset($image) && !empty($image) ? Dee::$app->baseUrl.'/public/uploads/administrator/'.$image : Dee::$app->baseUrl .'/public/uploads/administrator/avatar.png' ;?>" alt="Avatar"></div> <div class="name"><?php echo isset($nama) ? $nama : 'No Login';?></div></a>
	                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
	                                        <a class="dropdown-item" href="<?= Dee::createUrl('admin/profile') ?>"><i class="fas fa-user-circle"></i> Profile</a>
	                                        <a class="dropdown-item" href="<?= Dee::createUrl('admin/dashboard/logout')?>"><i class="fas fa-sign-out-alt"></i> Log Out</a>
	                                    </div>
	                                </li>
	                            </ul>
	                        </div>
	                    </div>
	                </div>
	            </header>

	            <div class="side-menu">
                <!-- ------------ Menu_kiri ----------->
	                <style>
.body-admin .side-menu ul li ul.active{background: #0C5757;padding-left: 25px;}
ul.drop-menu li:first-child  { animation-name: menu-1; animation-delay: -150ms; animation-duration: 600ms; animation-fill-mode: forwards; animation-timing-function: ease-in-out;}
ul.drop-menu li:last-child { animation-name: menu-1; animation-delay: 0ms; animation-duration: 600ms; animation-fill-mode: forwards; animation-timing-function: ease-in-out;}

@keyframes menu-1 {
  0% {
    opacity: 0;
    transform: rotateY(90deg);
    margin-top: -50px;
  }
  80% {
    margin-top: 0px;
    transform: rotateY(90deg);
  }
  90% {
    transform: rotateY(-10deg);
    margin-top: 5px;
  }
  100% {
    opacity: 1;
    margin-top: 0px;
    transform: rotateY(0deg);
  }
}
</style>

<ul>
    <li class="<?php echo !isset($is_active) || empty($is_active) || (isset($is_active) && $is_active == "dashboard") ? "active" : NULL;?>"><a href="<?= Dee::createUrl('panel')?>"><i class="fas fa-home"></i> Dashboard</a></li>
   	 <!-- <li class="<?php echo isset($is_active) && $is_active == "pages" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/pages')?>"><i class="fas fa-sitemap"></i> ProFile</a></li> -->
     <li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "berita" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/berita')?>"><i class="fas fa-bullhorn"></i> Berita</a></li>
     <!-- <li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "kinerja" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/kinerja')?>"><i class="fas fa-camera"></i> Kinerja OPD</a></li> -->
      <!-- <li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "agenda" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/agendaa')?>"><i class="fas fa-file"></i> Agenda</a></li> -->
     <div style="background: #5a0606;">
     <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-1" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/slide')?>"><i class="fas fa-film"></i> Gallery Slide</a></li> -->
     <li class="<?php echo isset($is_active) && $is_active == "slide-2" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/banner')?>"><i class="fas fa-film"></i> Gallery Banner </a></li>
     <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-3" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/foto')?>"><i class="fas fa-film"></i> Gallery Foto </a></li> -->
    <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-10" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/youtube')?>"><i class="fas fa-film"></i> Gallery Video</a></li> -->
    <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-4" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/dokumen')?>"><i class="fas fa-film"></i> Gallery Dokumen</a></li> -->
    <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-5" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/sdm')?>"><i class="fas fa-film"></i> Gallery SDM</a></li> -->
      <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-6" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/musik')?>"><i class="fas fa-film"></i> Gallery Musik</a></li> -->
   </div>
    <!-- <li class="<?php echo isset($is_active) && $is_active == "slide-7" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('panel/link')?>"><i class="fas fa-link"></i> Link Terkait</a></li> -->
   
    <li class="<?php echo isset($is_active) && $is_active == "settings" ? "active" : NULL; ?>"><a href="<?= Dee::createUrl('admin/settings')?>"><i class="fas fa-cog"></i> Settings</a></li>
   

</ul>

 <!-- ------------ END Menu_kiri ----------->

	            </div>

	           	<div class="body">
                	<div class="content-wrapper">
