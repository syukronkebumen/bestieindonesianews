

    <!--Page Title-->
    <section class="page-title" style="background-image:url(./public/assets/images/bg_bappeda.jpeg)">
    	<div class="auto-container">
        	<h2><?= $nav ?></h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<section class="project-section style-two">
		<div class="outer-container">
			
			<div class="masonry-items-container row clearfix" style="position: relative; ">
				<?php 	if (count($kinerja) > 0)
	{
		$n = 0;
		foreach ($kinerja as $g):
			$n++;
			$artikelImage = isset($g['img_header']) && is_file(Dee::$app->basePathe .
				'/uploads/artikel/' . $g['img_header']) ? Dee::$app->baseUrl .
				'/public/uploads/artikel/' . $g['img_header'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/slide.jpg'; ?>
				
				<!-- Gallery Item -->
				<div class="gallery-item  masonry-item col-lg-4 col-md-6 col-sm-12" >
					<div class="inner-box">
						<figure class="image-box" style="height: 225px;">
							<img src="<?= $artikelImage ?>" alt="">
							<!--Overlay Box-->
							<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href=""><?= $g['title'] ?></a></h3>
										<a href="<?= $artikelImage ?>" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>
                
                <?php endforeach;
	} else
	{
		echo "Tidak menemukan Apapun";
	} ?>
                
					
			</div>
			
		</div>		
		
		
			<!-- More Projects -->
			<div class="more-projects">
				<?= $pagination ?>
			</div>
		
		</div>
	</section>
