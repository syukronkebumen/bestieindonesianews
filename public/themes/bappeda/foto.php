<style>

.all{
    display: none;
}
.more-0{
    display: block;
}</style>
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
<!-- Project Section -->
	<section class="project-section" >
		<div class="auto-container">
			<!-- Title Box -->
			<div class="title-box">
				<h2>Our Latest Gallery</h2>
			</div>
		</div>
		
		<div class="outer-container">
			
			<!--Isotope Galery-->
            <div class="sortable-masonry">
                
                <!--Filter-->
                <div class="filters clearfix">
                	
                	<ul class="filter-tabs filter-btns text-center clearfix">
                        <li class="active filter" data-role="button" data-filter=".all">Semua</li>
						<li class="filter" data-role="button" data-filter=".foto">foto</li>
						<li class="filter" data-role="button" data-filter=".video">video</li>
                    </ul>
                    
                </div>
                
				<div class="items-container row clearfix">
				
						<?php 	if (count($data['lists']) > 0) {
		                  $n = 0;
		                  foreach ($data['lists'] as $g):
			              $n++;
			     $artikelImage = isset($g['image_url']) && is_file(Dee::$app->basePathe .
				'/uploads/slide/' . $g['image_url']) ? Dee::$app->baseUrl .
				'/public/uploads/slide/' . $g['image_url'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/slide.jpg'; 
                  $c = floor($n/10);
                ?>
				
				<!-- Gallery Item -->
				<div class="gallery-item small-block masonry-item all foto more-<?=$c?> " >
					<div class="inner-box">
					 <figure class="image-box" style="height: 200px; background-image: url(<?= $artikelImage ?>) ; background-size:cover; background-position: center;">
						<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href=""><?= $g['title_img'] ?></a></h3>
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
            <?php 	function youtube($url)
	{
		$link = str_replace('https://www.youtube.com/watch?v=', '', $url);
		return $link;
	}

	if (count($ytb['lists']) > 0)
	{
		$i = $n;
		foreach ($ytb['lists'] as $item): $i++; $d = floor($i/10);
        ?>                
				<!-- News Block -->
				<div class="gallery-item small-block masonry-item all video more-<?=$d?>">
                    <div class="inner-box ">
                    <figure class="image-box" style="height: 200px; background-image: url(https://img.youtube.com/vi/<?= youtube($item['description']) ?>/mqdefault.jpg); background-size:cover; background-position: center;">
						  <div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										
										<a href="https://www.youtube.com/watch?v=<?= youtube($item['description']) ?>" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-play-button"></span></a>
									</div>
								</div>
							</div>
						</figure>
              		</div>
				</div>
			<?php endforeach;
	} else	{
		echo "Tidak menemukan Apapun";
	} 
    
    $a = $i;
    foreach($art as $gaa):
    $image = isset($gaa['img_header']) && is_file(Dee::$app->basePathe .
				'/uploads/artikel/' . $gaa['img_header']) ? Dee::$app->baseUrl .
				'/public/uploads/artikel/thumb/' . $gaa['img_header'] : Dee::$app->baseUrl .
				'/public/assets/images/no-image/slide.jpg'; 
        $a++;        
	    $e = floor($a/10);
			
echo '<div class="gallery-item small-block masonry-item all foto more-'.$e.'" data-id="'.$e.'">
					<div class="inner-box">
							 <figure class="image-box" style="height: 200px; background-image: url('. $image .') ; background-size:cover; background-position: center;">
								<div class="overlay-box">
								<div class="overlay-inner">
									<div class="content">
										<h3><a href="">'.$gaa['title'] .'</a></h3>
										<a href="'.Dee::$app->baseUrl .'/public/uploads/artikel/' . $gaa['img_header'].'" data-fancybox="gallery-2" data-caption="" class="link"><span class="icon flaticon-magnifying-glass-1"></span></a>
									</div>
								</div>
							</div>
						</figure>
					</div>
				</div>';
              endforeach;
    ?>        
					
					
				</div>
			</div>
		
			<!-- More Projects -->
			<div class="more-projects">
            <a href="javascript:void(0)"  onclick="load_p(1)" class="btn btn-lg btn-secondary projects">Lihat Lainnya2</a>
         	</div>
		</div>
	</section>
	<!-- End Project Section -->
    
    <script> 
    function load_p(id){
    var idn = id + 1;
    var $container=$('.sortable-masonry .items-container');
    $(".more-"+id).show();
    $('.more-projects').html('	<a href="javascript:void(0)" onclick="load_p('+idn+')" class="btn btn-lg btn-primary projects">Lihat Lainnya</a>');         
    			$container.isotope({
				filter:'*',
				animationOptions:{
					duration:500,
					easing:'linear'
    			}
			});
    }

</script>
