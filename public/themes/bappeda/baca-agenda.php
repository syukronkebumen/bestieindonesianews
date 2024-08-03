  <style>
  .pric {
    width: 200px;
    display: block;
    float: left;
}
</style>
    <!--Page Title-->
    <section class="page-title" style="background-image:url(../public/assets/images/bg_bappeda.jpeg)">
    	<div class="auto-container">
        	<h2><?= $nav ?></h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!--Shop Single Section-->
    <section class="shop-single-section">
    	<div class="auto-container">
        	
            <div class="shop-single">
                <div class="product-details">
                    
                    <!--Basic Details-->
                    <div class="basic-details">
                        <div class="row clearfix">
                            <div class="image-column col-lg-6 col-md-12 col-sm-12">
                                <figure class="image-box"><a href="../public/themes/bappeda/img/kantor.jpg" class="lightbox-image" title="Image Caption Here">
                                <img src="../public/themes/bappeda/img/kantor.jpg" alt=""/></a></figure>
                            </div>
                            <div class="info-column col-lg-6 col-md-12 col-sm-12">
                            	<div class="inner-column">
                                    <h2>TEMA :</h2>
                                    <h3> <?= $single['tema'] ?></h3>
                                    <div class="text"><?= $single['detail'] ?> </div>
                                    <div class="price"><span class="pric" >Tgl. Pelaksanaan  </span> : <?= $single['tgl_pelaksanaan'] ?> </div>
                                    <div class="price"><span class="pric">Waktu  </span> : <?= $single['waktu'] ?> </div>
                                    <div class="price"><span class="pric">Lokasi  </span> : <?= $single['tempat'] ?> </div>
                                    
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Basic Details-->
            
                    
                </div>
            </div>
            
        </div>
    </section>
    <!--End Shop Single Section-->
	

