<style>
	article.post a {
		color: #000;
		font-weight: 600;
	}

	article.post a:hover {
		color: #F2C00A;

	}

	article.post {
		position: relative;
		font-size: 14px;
		color: #666666;
		padding: 0px 0px;
		padding-left: 130px;
		min-height: 90px;
		margin-bottom: 22px;
		border-bottom: 1px solid #e1e1e1;
	}

	article.post .post-thumb {
		position: absolute;
		left: 0px;
		top: 0px;
		width: 120px;
		height: 85px;
		background-size: cover;
		background-position: center;
	}

	article .post-info {
		font-size: 14px;
		color: #9a9a9a;
		font-weight: 400;
	}
</style>
<!-- News Section -->
<section class="services-section sidebar-page-container">
	<div class="auto-container">
		<!-- Sec Title -->
		<div class="row clearfix">
			<div class="content-side col-xl-9 col-lg-8 col-md-12 col-sm-12">
				<div class="sec-title">
					<h2>Berita Terbaru </h2>
					<div class="text">Informasi seputar kegiatan dan Aktifitas </div>
				</div>

				<div class="row clearfix">

					<?php $i = 0;
					foreach ($artikel as $a) :
						$i++;
						$artikelImage = isset($a['img_header']) && is_file(Dee::$app->basePathe .
							'/uploads/artikel/' . $a['img_header']) ? Dee::$app->baseUrl .
							'/public/uploads/artikel/' . $a['img_header'] : Dee::$app->baseUrl .
							'/public/assets/images/no-image/poster.jpg';
						if ($i == '1') { ?>

							<!-- News Block -->
							<div class="news-block col-lg-6 col-md-8 col-sm-12">
								<div class="inner-box wow fadeInRight" data-wow-delay="0ms" data-wow-duration="1500ms">
									<div class="sm-up-content">
										<h3><a href="<?= Dee::createUrl('read/' . $a['slug']) ?>"><?= $a['title'] ?></a></h3>
										<ul class="post-meta">
											<li>On : <span><?= date('M d, Y', strtotime($a['date'])) ?></span></li>
											<li><?= Dee::singkatAngka($a['views']); ?> views</li>
										</ul>
									</div>
									<div class="image">
										<a href="<?= Dee::createUrl('read/' . $a['slug']) ?>"><img src="<?= $artikelImage ?>" alt="<?= substr(
																																		$a['title'],
																																		0,
																																		100
																																	) ?>" /></a>
									</div>
									<div class="lower-content">
										<ul class="post-meta">
											<p><?= $a['caption'] ?></p>
										</ul>
										<p><?= substr($a['content'], 0, 500) ?> ... </p>
										<a href="<?= Dee::createUrl('read/' . $a['slug']) ?>" class="read-more">Read more <span class="icon flaticon-right-arrow-1"></span></a>
									</div>
								</div>
							</div>
					<?php }
					endforeach; ?>

					<div class="news-block col-lg-6 col-md-8 col-sm-12">
						<div class="wow fadeInRight" data-wow-delay="250ms" data-wow-duration="1500ms">
							<?php $na = 0;
							foreach ($artikel as $ats) :
								$atsImage = isset($ats['img_header']) && is_file(Dee::$app->basePathe .
									'/uploads/artikel/thumb/' . $ats['img_header']) ?
									'public/uploads/artikel/thumb/' . $ats['img_header'] : Dee::$app->baseUrl .
									'/public/assets/images/no-image/poster.jpg';
								$na++;
								if ($na <> '1') { ?>
									<article class="post">
										<figure class="post-thumb" style="background-image: url(<?= $atsImage ?>) ;"></figure>
										<div class="text"><a href="<?= Dee::createUrl('read/' .	$ats['slug']) ?>"><?= substr($ats['title'], 0, 60) ?> ...</a></div>
										<div class="post-info "><small> On : <?= $ats['date'] ?> | by Redaksi | <?= Dee::singkatAngka($ats['views'] + 350); ?> views </small></div>
									</article>
							<?php }
							endforeach; ?>

						</div>
					</div>


				</div>
			</div>
			<div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12">
				<aside class="sidebar wow fadeInRight" data-wow-delay="500ms" data-wow-duration="1500ms" <?php if (isset($agenda) && $agenda != null) { ?> <div class="sidebar-widget contact-widget">
					<div class="sidebar-title">
						<h2>Agenda</h2>
						<div class="text">Agenda Kegiatan </div>
					</div>
					<?php foreach ($agenda as $d) : ?>
						<div class="widget-content" style="background-image: url(public/themes/bappeda/img/gajah.jpg); color: #fff;">
							<p style="color: #fff;position: relative;"><?= $d['tgl_pelaksanaan'] ?><br />
								<?= $d['tema'] ?></p>

							<a href="tema/<?= $d['agenda_id'] ?>" class="theme-btn btn-style-one"><span class="txt">Detail</span></a>
						</div>
					<?php endforeach ?>
			</div>
		<?php } ?>
		<div class="sidebar-widget sidebar-blog-category">
			<div class="sidebar-title">
				<h2>Advertisment</h2>
				<div class="text">Advertisment</div>
			</div>
			<div class="flyer-carousel-bak owl-theme owl-carousel owl-loaded owl-drag">
				<?php foreach ($galery as $ld) :
					echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' . $ld['image_url']) . '" src="' . Dee::createUrl('public/uploads/slide/' . $ld['image_url']) . '"   alt="" ></a>';
				endforeach ?>
			</div>

		</div>

		</aside>
		</div>

	</div>
	</div>
</section>
<!-- End News Section -->