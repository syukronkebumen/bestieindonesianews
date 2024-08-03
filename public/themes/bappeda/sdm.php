<?php $theme = '/bappeda/public/themes/bappeda'; ?>
    <!--Page Title-->
    <section class="page-title" style="background-image:url(<?= $theme ?>/images/background/5.jpg)">
    	<div class="auto-container">
        	<h2>Our Team SDM</h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Team Page Section -->
	<section class="team-page-section">
		<div class="auto-container">
			
			<!-- Sec Title -->
			<div class="sec-title">
				<h2>STAFF DAN PEGAWAI</h2>
				<div class="text">Badan Perencanaan Pembangunan Daerah Kabupaten Lampung Timur. </div>
			</div>
			
			<div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '1')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '2')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '3')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }
	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '4')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '5')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '6')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
                <div class="sdm clearfix">
            
				<?php foreach ($data as $g):
		$artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
			'/uploads/warga/' . $g['image_url']) ? Dee::$app->baseUrl .
			'/public/uploads/warga/' . $g['image_url'] : Dee::$app->baseUrl .
			'/public/assets/images/no-image/avatar.jpg';
		if ($g['id_album'] == '7')
		{ ?>		
				<!-- Team Block -->
				<div class="team-block col-lg-3 col-md-6 col-sm-12">
					<div class="inner-box">
						<div class="image">
							<img src="<?= $artikelImage ?>" alt="" />
							<div class="overlay-box">
								<ul class="social-icons">
									<li><a href="#"><i class="fab fa-facebook"></i></a></li>
									<li><a href="#"><i class="fab fa-linkedin"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter-square"></i></a></li>
									<li><a href="#"><i class="fab fa-skype"></i></a></li>
								</ul>
							</div>
						</div>
						<div class="lower-content">
							<h3><a href="team.html"><?= $g['title_img'] ?></a></h3>
							<div class="designation"><?= $g['description'] ?></div>
						</div>
					</div>
				</div>
				<?php }	endforeach; ?>
                </div>
        
			
		</div>
	</section>
	<!-- End Story Section -->
	
