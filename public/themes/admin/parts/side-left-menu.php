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
    <li class="list-title <?php echo !empty($akses) && in_array('administrator',$akses) || $superadmin == TRUE ? NULL : ' d-none';?>">Web Settings</li>
    <li class="<?php echo !isset($is_active) || empty($is_active) || (isset($is_active) && $is_active == "dashboard") ? "active" : NULL;?>"><a href="<?php echo Dee::$app->baseUrl;?>dashboard"><i class="fas fa-home"></i> Dashboard</a></li>
    <li class="<?php echo isset($is_active) && $is_active == "settings" ? "active" : NULL; ?>"><a href="settings"><i class="fas fa-cogs"></i> Settings</a></li>
    	<!--G kepakai
        <li><a href="#"><i class="fas fa-bullhorn"></i> Berita</a>
	<ul class="drop-menu">
			<li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "berita" ? "active" : NULL; ?>"><a href="berita">Semua Berita</a></li>
			<li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "value" ? "active" : NULL; ?>"><a href="value">Kategori Berita</a></li>
		</ul>
        
	</li>-->
   	<li class="<?php echo isset($is_active) && empty($is_active2) && $is_active == "berita" ? "active" : NULL; ?>"><a href="berita"><i class="fas fa-bullhorn"></i> Berita</a></li>
    <li class="<?php echo isset($is_active) && $is_active == "pages" ? "active" : NULL; ?>"><a href="pages"><i class="fas fa-file"></i> pages</a></li>
  <!--   <li class="<?php echo isset($is_active) && $is_active == "slide" ? "active" : NULL; ?>"><a href="slide"><i class="fas fa-images"></i> Galery Slider</a></li>
   -->
</ul>


