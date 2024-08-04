<style>
.news-block-two .inner-box .image {
   height: 315px;
}
.news-block-two .inner-box .lower-content .lower-box h3 {
       font-size: 22px;
       }
 .news-block-two .inner-box .lower-content {
    height: 375px;
}      
</style>
    <!--Page Title-->
    <section class="page-title" style="background-image:url(../public/assets/images/newslatter.jpeg)">
    	<div class="auto-container">
        	<h2><?= $nav ?></h2>
            <ul class="page-breadcrumb">
            	<li><a href="">home</a></li>
                <li><?= $nav ?></li>
            </ul>
        </div>
    </section>
    <!--End Page Title-->
	
	<!-- Our Blogs Section -->
	<section class="our-blogs-section">
		<div class="auto-container">
			<div class="row clearfix">
				<?php 	if (count($lists) > 0)
	{
		$n = 0;
		foreach ($lists as $b):
			$n++;
			$artikelImage = isset($b['img_header']) && is_file(Dee::$app->basePathe .
				'/uploads/artikel/' . $b['img_header']) ? Dee::$app->baseUrl .
				'/public/uploads/artikel/' . $b['img_header'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/poster.jpg'; ?>
				<!--News Block Two -->
				<div class="news-block-two style-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
						<div class="image">
							<a href="<?= Dee::createUrl('/read/' . $b['slug']) ?>"><img src="<?= $artikelImage ?>" alt="" /></a>
						</div>
						<div class="lower-content">
							<div class="upper-box clearfix">
								<div class="posted-date"><?= $b['date'] ?></div>
								<ul class="post-meta">
									<li>By :  Admin</li>
									<li><?= $nav ?></li>
									<li>Dilihat : <?= $b['views'] ?> kali</li>
								</ul>
							</div>
							<div class="lower-box">
								<h3><a href="<?= Dee::createUrl('/read/' . $b['slug']) ?>"><?= substr($b['title'],0, 150) ?></a></h3>
								<div class="text"><?= strip_tags(substr($b['content'], 0, 300)) ?>.</div>
								<a href="<?= Dee::createUrl('/read/' . $b['slug']) ?>" class="theme-btn read-more">Read more</a>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach;
	} else
	{
		echo "Tidak menemukan Apapun";
	} ?>
                    
				
			
			
			
				
			</div>
			
			<!--Styled Pagination-->
			       <?= $pagination ?>
			<!--End Styled Pagination-->
			
		</div>
	</section>
	<!-- End Our Blogs Section -->
