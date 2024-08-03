
<style>
span.ket{
    width: 65px;
    display: block;
    float: left;
    font-weight: 600;
}
.service-block-two .inner-box .content .icon-box {
    color: #fffdfb;
    font-size: 50px;
    background: #34e9a6;
    padding: 2px 8px;
    border-radius: 5px;
    font-weight: 700;
}
.service-block-two .inner-box .content .icon-box .tex{
    font-size: 12px;
    text-align: center;
    margin-bottom: 0;
    font-weight: 600;
    }
</style>
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
	
	<section class="services-section-two">
		<div class="auto-container">
			<!-- Sec Title -->
			<div class="sec-title">
				<h2><?= $nav ?></h2>
			</div>
			
			<div class="row clearfix">
				<?php 	if (count($lists) > 0)
	{
		$n = 0;
		foreach ($lists as $b):
			$n++; ?>
				<!-- Service Block -->
				<div class="service-block-two col-lg-4 col-md-6 col-sm-12">
					<div class="inner-box wow fadeInLeft animated" data-wow-delay="0ms" data-wow-duration="1500ms" style="visibility: visible; animation-duration: 1500ms; animation-delay: 0ms; animation-name: fadeInLeft;">
						<div class="content">
							<div class="icon-box">
								<?= date('d', strtotime($b['tgl_pelaksanaan'])) ?>
                                <p class="tex"><?= date('M Y', strtotime($b['tgl_pelaksanaan'])) ?></p>
							</div>
							<h3><a href="<?= Dee::createUrl('tema/' . $b['agenda_id']) ?>"> <?= strip_tags(substr($b['title'], 0, 30)) ?></a></h3>
							<div class="text"><?= strip_tags(substr($b['detail'], 0, 50)) ?></div>
                           
				<span class="ket"> Tanggal</span> <span> :  <?= $b['date'] ?> </span>
                <br />
                <span class="ket" >Waktu </span><span> : <?= $b['waktu'] ?></span>
                <br />
                <span class="ket">Tempat </span><span>: <?= $b['tempat'] ?></span>
                 
                 <br />				
                 
							<a href="<?= Dee::createUrl('tema/' . $b['agenda_id']) ?>" class="read-more">Read More</a>
						</div>
					</div>
				</div>
				<?php endforeach;
	} else
	{
		echo "Tidak menemukan Apapun";
	} ?>
                    
				
				
			</div>
			 <?= $pagination ?>
		</div>
	</section>