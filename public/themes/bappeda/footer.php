<style>
    .sidebar .popular-tags a {
        padding: 0px 17px 0px;
    }

    .hr,
    .is {
        width: 70px;
        display: block;
        float: left;
    }

    .is {
        margin-right: 20px;
    }

    audio {
        position: fixed;
        bottom: 20px;
        right: 100px;
        z-index: 100;
    }

    .fa-music,
    .fa-volume-up {
        position: fixed;
        right: 25px;
        bottom: 10%;
        width: 40px;
        height: 40px;
        border: 1px solid transparent;
        z-index: 100;
        cursor: pointer;
        line-height: 38px;
        text-align: center;
        border-radius: 50%;
        box-shadow: 0 0 2px #444444;
        text-shadow: 0 0 1px #444444;
        color: #ff9801;
        border-color: #ff9801;

    }

    .fa-music.pause:after,
    .fa-volume-up.pause:after {
        content: '';
        position: absolute;
        left: 50%;
        width: 3px;
        height: 100%;
        transform: rotate(-36deg);
        background-color: #ff9801;
    }
</style>
<!--Main Footer-->
<footer class="main-footer">
    <div class="auto-container">
        <!--Widgets Section-->
        <div class="widgets-section">
            <div class="row clearfix">

                <!--big column-->
                <div class="big-column col-lg-12 col-md-12 col-sm-12">
                    <div class="row clearfix">

                        <!--Footer Column-->
                        <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <div class="logo">
                                    <a href="<?= Dee::createUrl('') ?>"><img src="<?= Dee::createUrl('public/uploads/BI-putih.png') ?>" alt="" title=""></a>
                                </div>
                                <div class="text" style="margin-bottom: 10px;"><?= $web['description'] ?></div>
                            </div>
                        </div>

                        <!--Footer Column-->
                        <div class="footer-column col-lg-4 col-md-6 col-sm-12">
                            <div class="footer-widget logo-widget">
                                <h2 class="widget-title">contact-us</h2>
                                <div class="widget-content">
                                    <div style="float: left; margin-top: 1px; margin-bottom: 1px; height: auto; width: 100%;"><?= $web['instansi'] ?><br>
                                    </div>
                                    <ul>
                                        <li><i class="fa fa-map-marker"></i> <?= $web['alamat'] ?></li>
                                        <li><i class="fa fa-phone"></i> <?= $web['hp'] ?></li>
                                        <li><i class="fa fa-envelope"></i> bestieindonesianews@gmail.com</li>
                                        <li><i class="fab fa-instagram"></i> @bestieindonesia</li>

                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="footer-column col-lg-4 col-md-6 col-sm-12 ">
                            <div class="footer-widget newsletter-widget sidebar">
                                <h2>Tags</h2>
                                <div class="textwidget custom-html-widget popular-tags">

                                    <?php foreach ($category as $cf) :
                                        echo '<a href="' . Dee::createUrl('category/' . $cf['isi']) .
                                            '" rel="noopener">' . $cf['isi'] . '</a>';
                                    endforeach ?>
                                    <small>
                                        <?php foreach ($portofolio as $pf) : ?>
                                            <a rel="noopener" href="<?= Dee::createUrl('/pages/' . $pf['slug']) ?>"><?= $pf['judul_menu'] ?></a>
                                        <?php endforeach; ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Footer Bottom-->
        <div class="footer-bottom clearfix">
            <div class="row">
                <div class="col-md-8">
                    <p> Copyright @ 2024 BESTIEINDONESIANEWS, All Rights Reserved</p>
                </div>
                <div class="col-md-4">
                    <a href="<?= Dee::createUrl('disclaimer') ?>">Disclaimer</a> |
                    <a href="<?= Dee::createUrl('pedoman') ?>">Pedoman Media SIBER</a> |
                    <a href="<?= Dee::createUrl('redaksi') ?>">Redaksi</a>            
                </div>
            </div>
        </div>

    </div>
</footer>

</div>
<!--End pagewrapper-->

<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-up"></span></div>

<!--Search Popup-->
<div id="search-popup" class="search-popup">
    <div class="close-search theme-btn"><span class="flaticon-cancel"></span></div>
    <div class="popup-inner">
        <div class="overlay-layer"></div>
        <div class="search-form">
            <form method="get" action="<?= Dee::createUrl('blog/post') ?>">
                <div class="form-group">
                    <fieldset>
                        <input type="search" class="form-control" name="q" value="" placeholder="Search Here" required>
                        <input type="submit" value="Search Now!" class="theme-btn">
                    </fieldset>
                </div>
            </form>

            <br>
            <h3>Recent Search Keywords</h3>
            <ul class="recent-searches">
                <li><a href="<?= Dee::createUrl('blog/post?q=bupati') ?>">Bupati</a></li>
                <li><a href="<?= Dee::createUrl('blog/post?q=bappeda') ?>">Bappeda</a></li>
                <li><a href="<?= Dee::createUrl('blog/post?q=lampung timur') ?>">Lampung Timur</a></li>
                <li><a href="<?= Dee::createUrl('blog/post?q=berjaya') ?>">Berjaya</a></li>
                <li><a href="<?= Dee::createUrl('blog/post?q=kabupaten') ?>">Kabupaten</a></li>
            </ul>

        </div>

    </div>
</div>

<!--Scroll to top-->
<script src="<?= $theme ?>/js/jquery.js"></script>
<script src="<?= $theme ?>/js/popper.min.js"></script>
<script src="<?= $theme ?>/js/jquery-ui.js"></script>
<script src="<?= $theme ?>/js/bootstrap.min.js"></script>
<script src="<?= $theme ?>/js/jquery.fancybox.js"></script>
<script src="<?= $theme ?>/js/isotope.js"></script>
<script src="<?= $theme ?>/js/owl.js"></script>
<script src="<?= $theme ?>/js/wow.js"></script>
<script src="<?= $theme ?>/js/appear.js"></script>
<script src="<?= $theme ?>/js/scrollbar.js"></script>
<script src="<?= $theme ?>/js/script.js"></script>
<script>
    $(window).on('load', function() {
        // audio
        $('.fa-music,.fa-volume-up').click(function() {
            if ($(this).hasClass('pause')) {
                $('#myAudio')[0].play();
            } else {
                $('#myAudio')[0].pause();
            }
            $(this).toggleClass('pause');

        });
    });
</script>
</body>

<!-- stella-orre/  30 Nov 2019 03:45:45 GMT -->

</html>