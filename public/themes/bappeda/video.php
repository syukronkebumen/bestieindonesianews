

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
	
	<section class="news-section featured-section" >
    
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title-two centered">
				<h2 style="color: #dfb162;">Video  Youtube</h2>
				<div style="color: #fff;" class="title-text">Tonton dan saksikan video tentang kegiatan di Youtube</div>
			</div>
			
			<div class="row clearfix">
				
                <?php 	function youtube($url)
	{
		$link = str_replace('https://www.youtube.com/watch?v=', '', $url);
		return $link;
	}
	$no = 0;
	if (count($data['lists']) > 0)
	{
		$n = 0;
		foreach ($data['lists'] as $item): ?>                
				<!-- News Block -->
				<div class="ytb news-block col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInRight animated animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInRight;">
							<div class="image" style="height: 210px; background-image: url(https://img.youtube.com/vi/<?= youtube($item['description']) ?>/hqdefault.jpg);">
						</div>
						<a href="https://www.youtube.com/watch?v=<?= youtube($item['description']) ?>" class="overlay-link lightbox-image">
						<div class="icon-box">
							<span class="icon flaticon-play-button"></span>
                            <i class="ripple"></i>
						</div>
					</a>
					</div>
				</div>
			<?php endforeach;
	} else	{
		echo "Tidak menemukan Apapun";
	} 
    ?>   
				
									
			</div>
			
		</div>
	</section>
