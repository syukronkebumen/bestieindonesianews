<style>
    .news-block .inner-box .image {
        height: 208px;
    }

    .news-block .inner-box .lower-content {
        height: 225px;
    }

    .sidebar1 .popular-tags a {
        position: relative;
        display: inline-block;
        line-height: 24px;
        padding: 8px 50px 8px;
        margin: 0px -4px 10px 0px;
        color: #FFFDFD;
        text-align: center;
        font-size: 15px;
        font-weight: 600;
        text-transform: capitalize;
        transition: all 300ms ease;
        -webkit-transition: all 300ms ease;
        -ms-transition: all 300ms ease;
        -o-transition: all 300ms ease;
        -moz-transition: all 300ms ease;
    }

    .sidebar1 .popular-tags a:hover {
        background: #FC5219;
        color: #EFD913;
    }

    .facebook {
        background: #3b5998;
    }

    .twitter {
        background: #55acee;
    }

    .whatsapp {
        background: #25d366;
    }
    
    .berita-view {
        font-family: Arial, sans-serif;
        line-height: 1.6;
    }

    .berita-view h1 {
        font-size: 2em;
        margin-bottom: 0.5em;
    }

    .berita-view .content {
        margin-bottom: 2em;
    }

    .berita-view .related-content {
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        padding: 1em;
        margin: 2em 0;
        border-radius: 8px;
    }

    .related-content {
        background: #f1f1f1 none repeat scroll 0 0;
        display: block;
        margin: 30px auto;
        padding: 10px 15px 5px;
        position: relative;
    }

    .berita-view .related-content h3 {
        font-size: 1.5em;
        margin-bottom: 0.5em;
    }

    .berita-view .related-content ul {
        list-style-type: none;
        padding: 0;
    }

    .related-content ul li {
        padding: 2px 0px 10px 0px;
    }

    .berita-view .related-content ul li a {
        text-decoration: none;
        color: #007bff;
    }

    .berita-view .related-content ul li a:hover {
        text-decoration: underline;
    }

    .berita-view .additional-content {
        margin-top: 2em;
    }
</style>
<?= 
    // Pisahkan konten menjadi dua bagian
    $contentParts = explode("</p>", $single['content']);
    $halfContentCount = ceil(count($contentParts) / 2);
?>
<!--Page Title-->
<section class="page-title" style="background-image:url(../public/themes/bappeda/images/background/5.jpg)">
    <div class="auto-container">
        <ul class="page-breadcrumb">
            <li><a href="">home</a></li>
            <li>Blog Details</li>
        </ul>
    </div>
</section>
<!--End Page Title-->

<!--Sidebar Page Container-->
<div class="sidebar-page-container">
    <div class="auto-container">
        <div class="row clearfix">

            <!--Content Side / Blog Classic -->
            <div class="content-side col-xl-9 col-lg-8 col-md-12 col-sm-12">
                <div class="blog-single padding-right">
                    <div class="inner-box">
                        <div class="lower-box">
                            <h3><?= $single['title'] ?></h3>
                        </div>
                        <div class="lower-content">
                            <div class="post-meta sidebar1">
                                <ul class="post-info clearfix">
                                    <li><a href=""><?= date("d-m-Y", strtotime($single['date'])) ?> : <?= date("H:i", strtotime($single['time'])) ?></a></li>
                                    <li><a href="">By : Redaksi</a></li>
                                    <li><a href="<?= Dee::createUrl('category/' . $single['isi']) ?>"><?= $single['isi'] ?></a></li>
                                    <li><a href="">dilihat : <?= $single['views'] ?> kali</a></li>
                                </ul>
                                
                            </div>
                        </div>
                        <div class="image-box">
                            <figure class="image"><img src="<?= $artikelImage ?>" alt=""></figure>
                        </div>
                        <div class="sm-caption">
                            <p><?= $single['caption'] ?></p>
                        </div>
                        <div class="lower-box">
                            <div class="text">
                                <?php
                                // Tampilkan bagian pertama dari konten
                                for ($i = 0; $i < $halfContentCount; $i++) {
                                    echo $contentParts[$i] . "</p>";
                                }
                            ?>
                            <div class="related-content shadow-sm p-3 mb-5 bg-white rounded">
                                <h3 style="padding-bottom: 10px;">Baca Juga</h3>
                                <ul style="list-style-type: none; padding: 0;">
                                    <?php foreach ($related_article as $berita): ?>
                                        <li style="display: flex; margin-bottom: 10px;">
                                            <img style="width: 60px; height: 60px; background-size: cover; border-radius: 12%;" src="<?= Dee::$app->baseUrl . '/public/uploads/artikel/'. $berita['img_header'] ?>" alt="image baca">
                                            <div style="padding-left: 10px;">
                                                <a href="<?= Dee::createUrl('read/' . $berita['slug']) ?>"> <?= substr($berita['title'], 0, 100) ?> ...</a>
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <?php
                                // Tampilkan bagian kedua dari konten
                                for ($i = $halfContentCount; $i < count($contentParts); $i++) {
                                    echo $contentParts[$i] . "</p>";
                                }
                            ?>
                            (**). 
                            </div>
                        </div>
                        <div class="post-meta sidebar1">
                            <span class="popular-tags" id="fb">
                                <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?= Dee::createUrl('read/' . $single['slug']) ?>" target="_blank"><i class="fab fa-facebook-f"></i>&nbsp;Fb</a>
                                <a class="twitter" href="http://twitter.com/share?url=<?= Dee::createUrl('read/' . $single['slug']) ?> " target="_blank"><i class="fab fa-twitter"></i>&nbsp;Tweet</a>
                                <a class="whatsapp" href="https://api.whatsapp.com/send?text=<?= Dee::createUrl('read/' . $single['slug']) ?>" target="_blank"><i class="fab fa-whatsapp"></i>&nbsp;Wa</a>
                                <a class="instagram" style="background: rgb(244,2,184);" href="<?= Dee::createUrl('read/' . $single['slug']) ?>" target="_blank"><i class="fab fa-instagram"></i>&nbsp;Instagram</a>
                                <a class="tiktok" style="background: rgb(0,0,0);" href="<?= Dee::createUrl('read/' . $single['slug']) ?>" target="_blank"><i class="fa-brands fa-tiktok"></i>&nbsp;Tiktok</a> 
                            </span>
                        </div>
                    </div>

                    <div id="comments" class="comments-area">

                        <div id="respond" class="comment-respond">
                            <div id="fb-root"></div>
                            <script>
                                //<![CDATA[
                                (function(d, s, id) {
                                    var js, fjs = d.getElementsByTagName(s)[0];
                                    if (d.getElementById(id)) return;
                                    js = d.createElement(s);
                                    js.id = id;
                                    js.src = 'https://connect.facebook.net/id_ID/sdk.js#xfbml=1&version=v3.1';
                                    fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                                //]]> 
                            </script>



                        </div><!-- #respond -->

                    </div><!-- #comments -->


                    <!-- Comment Form -->
                    <div class="comment-form">

                        <div class="group-title">
                            <h2>Leave a Comment</h2>
                        </div>
                        <div class="form-inner">
                            <!--Comment Form-->
                            <form method="post" action="contact/save">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <input type="text" name="username" placeholder="Your name" required>
                                    </div>

                                    <div class="col-md-6 col-sm-6 col-xs-12 form-group">
                                        <input type="email" name="email" placeholder="Email address" required>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <textarea name="message" placeholder="Write message"></textarea>
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 form-group">
                                        <button class="theme-btn submit-btn" type="submit" name="submit-form">Post Comment</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                    <!--End Comment Form -->

                </div>
            </div>

            <!--Sidebar Side-->
            <div class="sidebar-side col-xl-3 col-lg-4 col-md-12 col-sm-12">
                <aside class="sidebar">

                    <!-- Search -->
                    <div class="sidebar-widget search-box">
                        <form method="get" action="../blog/post">
                            <div class="form-group">
                                <input type="search" name="q" value="" placeholder="Enter Search Keywords" required>
                                <button type="submit"><span class="icon fa fa-search"></span></button>
                            </div>
                        </form>
                    </div>

                    <!--Blog Category Widget-->
                    <div class="sidebar-widget sidebar-blog-category">
                        <div class="sidebar-title">
                            <h2>ADVERTISMENT</h2>
                        </div>
                        <div class="flyer-carousel-bak owl-theme owl-carousel owl-loaded owl-drag">
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'glsnew.jpeg') . '" src="' . Dee::createUrl('public/uploads/slide/' .'glsnew.jpeg') . '"   alt="" ></a>';
                            ?>
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'adv1.png') . '" src="' . Dee::createUrl('public/uploads/slide/' .'adv1.png') . '"   alt="" ></a>';
                            ?>
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'ucapan-bkd.jpg') . '" src="' . Dee::createUrl('public/uploads/slide/' .'ucapan-bkd.jpg') . '"   alt="" ></a>';
                            ?>
                            
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'pwi.jpeg') . '" src="' . Dee::createUrl('public/uploads/slide/' .'pwi.jpeg') . '"   alt="" ></a>';
                            ?>
                            
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'mkks.jpg') . '" src="' . Dee::createUrl('public/uploads/slide/' .'mkks.jpg') . '"   alt="" ></a>';
                            ?>
                            
                            <?php 
                                echo '<a href="#" target="_self" ><img class="mb-2" data-thumb="' . Dee::createUrl('public/uploads/slide/' .'k3s.jpg') . '" src="' . Dee::createUrl('public/uploads/slide/' .'k3s.jpg') . '"   alt="" ></a>';
                            ?>
                        </div>
                    </div>

                    <!-- Popular Posts -->
                    <div class="sidebar-widget popular-posts">
                        <div class="sidebar-title">
                            <h2>Berita Populer</h2>
                        </div>
                        <?php $na = 0;
                        foreach ($berita_populer as $ats) :
                            $atsImage = isset($ats['img_header']) && is_file(Dee::$app->basePathe .
                                '/uploads/artikel/thumb/' . $ats['img_header']) ?
                                '../public/uploads/artikel/thumb/' . $ats['img_header'] : Dee::$app->baseUrl .
                                '/public/assets/images/no-image/poster.jpg';
                            if ($ats['id'] <> $single['id']) {
                                $na++; ?>
                                <article class="post">
                                    <figure class="post-thumb" style="background-image: url(<?= $atsImage ?>) ;"></figure>
                                    <div class="text"><a href="<?= Dee::createUrl('read/' . $ats['slug']) ?>"><?= substr($ats['title'], 0, 100) ?> ...</a></div>
                                    <div class="post-info"><?= $ats['views'] ?> views | <?= $ats['date'] ?></div>
                                </article>
                        <?php }
                        endforeach; ?>

                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>