<!DOCTYPE html>
<html lang="en">

<!-- stella-orre/  30 Nov 2019 03:42:43 GMT -->

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-BERYNDYNXN"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-BERYNDYNXN');
    </script>
    <meta charset="utf-8">
    <title><?= $title ? $title : "Bestie Indonesia News" ?></title>
    <meta name="keywords" content="<?= str_replace(" ", ",", strip_tags($description)) ?>">
    <meta name="description" content="<?= strip_tags($description) ?>">
    <meta name="author" content="lampung timur">
    <meta property="og:site_name" content="<?= Dee::$app->baseUrl ?>" />
    <meta property="og:title" content="<?= strip_tags($title) ?>" />
    <meta property="og:url" content="<?= Dee::$app->baseUrl ?>" />
    <meta property="og:description" content="<?= strip_tags($description) ?>" />
    <meta property="og:type" content="website" />
    <meta property="article:author" content="lampungtimur" />
    <meta property="article:publisher" content="lampung timur" />
    <meta property="og:image" content="<?= $gambar ?>" />
    <meta name="twitter:image" content="<?= $gambar ?>" />
    <meta name="twitter:card" content="summary_large_image">

    <!-- Stylesheets -->
    <link href="<?= $theme ?>/css/bootstrap.css" rel="stylesheet">
    <link href="<?= $theme ?>/css/style.css" rel="stylesheet">
    <link href="<?= $theme ?>/css/responsive.css" rel="stylesheet">

    <link rel="shortcut icon" href="<?= Dee::$app->baseUrl ?>/favicon.ico" />
    <link rel="icon" href="<?= Dee::$app->baseUrl ?>/favicon.png" type="image/x-icon">

    <!-- Responsive -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="google-adsense-account" content="ca-pub-5321156983100513">
    <!--[if lt IE 9]><script src="<?= $theme ?>/https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script><![endif]-->
    <!--[if lt IE 9]><script src="<?= $theme ?>/js/respond.js"></script><![endif]-->
    <style>
        .news-block .inner-box .lower-content .post-meta li:last-child {
            margin-right: 0px;
            border-right: 0px;
            padding-right: 0px;
        }

        .testimonial-block .inner-box {
            border-radius: 10px;
        }

        .testimonial-block .inner-box .content {
            padding-left: 0;
        }

        .testimonial-section {
            position: relative;
            padding: 150px 0px 90px;
            background-position: center bottom;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }

        .service-block .inner-box .lower-content .post-meta li {
            position: relative;
            color: #797979;
            font-size: 15px;
            display: inline-block;
            padding-right: 15px;
            margin-right: 15px;
            line-height: 1.3em;
            border-right: 1px solid #242424;
        }

        .news-section .ytb .overlay-link .icon-box {
            position: absolute;
            left: 50%;
            top: 50%;
            width: 80px;
            height: 80px;
            color: #ffffff;
            font-size: 22px;
            padding-left: 6px;
            line-height: 80px;
            text-align: center;
            border-radius: 50%;
            margin-bottom: 50px;
            display: inline-block;
            margin-left: -40px;
            margin-top: -40px;
            background-color: #ED2F09;
        }

        .news-section .ytb .overlay-link {
            position: absolute;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.03);
            transition: all 0.6s ease;
            -moz-transition: all 0.6s ease;
            -webkit-transition: all 0.6s ease;
            -ms-transition: all 0.6s ease;
            -o-transition: all 0.6s ease;
        }


        .news-section .ytb .overlay-link .ripple,
        .news-section .ytb .overlay-link .ripple:before,
        .news-section .ytb .overlay-link .ripple:after {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            -ms-border-radius: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
            -moz-box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
            -ms-box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
            -o-box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
            box-shadow: 0 0 0 0 rgba(255, 255, 255, .6);
            -webkit-animation: ripple 3s infinite;
            -moz-animation: ripple 3s infinite;
            -ms-animation: ripple 3s infinite;
            -o-animation: ripple 3s infinite;
            animation: ripple 3s infinite;
        }

        .news-section .ytb .overlay-link .ripple:before {
            -webkit-animation-delay: .9s;
            -moz-animation-delay: .9s;
            -ms-animation-delay: .9s;
            -o-animation-delay: .9s;
            animation-delay: .9s;
            content: "";
            position: absolute;
        }

        .news-section .ytb .overlay-link .ripple:after {
            -webkit-animation-delay: .6s;
            -moz-animation-delay: .6s;
            -ms-animation-delay: .6s;
            -o-animation-delay: .6s;
            animation-delay: .6s;
            content: "";
            position: absolute;
        }

        @-webkit-keyframes ripple {
            70% {
                box-shadow: 0 0 0 40px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        @keyframes ripple {
            70% {
                box-shadow: 0 0 0 40px rgba(255, 255, 255, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0);
            }
        }

        li.current {
            border-bottom: 2px solid #dc8b14;
        }
    </style>
    <script>
        document.addEventListener('contextmenu', function(event) {
            event.preventDefault();
        });

        // Menonaktifkan fungsi copy
        document.addEventListener('copy', function(event) {
            event.preventDefault();
        });

        // Menonaktifkan fungsi cut
        document.addEventListener('cut', function(event) {
            event.preventDefault();
        });

        // Menonaktifkan fungsi paste
        document.addEventListener('paste', function(event) {
            event.preventDefault();
        });
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5321156983100513"
     crossorigin="anonymous"></script>
    <script async src="https://fundingchoicesmessages.google.com/i/pub-5321156983100513?ers=1" nonce="F9qY9xKWTyZynsohbAnE7g"></script><script nonce="F9qY9xKWTyZynsohbAnE7g">(function() {function signalGooglefcPresent() {if (!window.frames['googlefcPresent']) {if (document.body) {const iframe = document.createElement('iframe'); iframe.style = 'width: 0; height: 0; border: none; z-index: -1000; left: -1000px; top: -1000px;'; iframe.style.display = 'none'; iframe.name = 'googlefcPresent'; document.body.appendChild(iframe);} else {setTimeout(signalGooglefcPresent, 0);}}}signalGooglefcPresent();})();</script>
</head>

<body>

    <div class="page-wrapper">
        <!-- Preloader -->
        <div class="preloader"></div>

        <header class="main-header header-style-one">
            <!--Header Top-->
            <div class="header-top">
                <div class="auto-container clearfix">
                    <div class="top-left clearfix">
                        <div class="text">
                            <?= $hari_ini ?>
                        </div>

                    </div>
                    <div class="top-right clearfix">
                        <!-- Info List -->
                        <ul class="info-list">
                            <li><a href="<?= $web['facebook'] ?>"><span class="fab fa-facebook-square"></span></a> </li>
                            <li><a href="<?= $web['youtube'] ?>"><span class="fab fa-youtube"></span></a></li>
                            <li><a href="<?= $web['instagram'] ?>"><span class="fab fa-instagram"></span></a></li>
                            <li class="quote"><a href="<?= Dee::createUrl('contact') ?>">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Header Top -->

            <!-- Header Upper -->
            <div class="header-upper">
                <div class="inner-container">
                    <div class="auto-container clearfix">
                        <!--Info-->
                        <div class="logo-outer">
                            <div class="logo">
                                <a href="<?= Dee::createUrl('') ?>">
                                    <img src="<?= Dee::createUrl('public/uploads/' . $web['logo']) ?>" alt="" title="">
                                </a>
                            </div>
                        </div>

                        <!--Nav Box-->
                        <div class="nav-outer clearfix">
                            <!--Mobile Navigation Toggler For Mobile-->
                            <div class="mobile-nav-toggler"><span class="icon flaticon-menu-1"></span></div>
                            <nav class="main-menu navbar-expand-md navbar-light">
                                <div class="navbar-header">
                                    <!-- Togg le Button -->
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="icon flaticon-menu-1"></span>
                                    </button>
                                </div>

                                <div class="collapse navbar-collapse clearfix" id="navbarSupportedContent">
                                    <ul class="navigation clearfix">
                                        <li class="<?= isset($is_active) && $is_active == 'home' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('') ?>">Home</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'nasional' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/nasional') ?>">Nasional</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'hukum' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/hukum') ?>">Hukum</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'ekonomi' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/ekonomi') ?>">Ekonomi</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'politik' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/politik') ?>">Politik</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'opini' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/opini') ?>">Opini</a>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'humaniora' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/humaniora') ?>">Humaniora</a>
                                        </li>
                                        <li class="dropdown <?php echo isset($is_active5) && $is_active5 == 'daerah' ? "current" : null; ?>"><a href="#" class="">Daerah</a>
                                            <ul>
                                                <?php 
                                                $category = [
                                                    'lampung-barat'=>'Lampung Barat',
                                                    'lampung-selatan' => 'Lampung Selatan',
                                                    'lampung-tengah' => 'Lampung Tengah',
                                                    'lampung-timur' => 'Lampung Timur',
                                                    'lampung-utara' => 'Lampung Utara',
                                                    'mesuji' => 'Mesuji',
                                                    'pesawaran' => 'Pesawaran',
                                                    'pesisir-barat' => 'Pesisir Barat',
                                                    'pringsewu' => 'Pringsewu',
                                                    'tanggamus' => 'Tanggamus',
                                                    'tulang-bawang' => 'Tulang Bawang',
                                                    'tulang-bawang-barat' => 'Tulang Bawang Barat',
                                                    'way-kanan' => 'Way Kanan',
                                                    'kota-bandar-lampung' => 'Kota Bandar Lampung',
                                                    'kota-metro' => 'Kota Metro'
                                                ];
                                                foreach ($category as $key => $value) :
                                                    $act = isset($is_active) && $is_active == $value ? "current" : null;
                                                    echo '<li class="' . $act . '"><a href="' . Dee::createUrl('category/' . $key) . '" >' . $value. '</a></li>';
                                                endforeach ?>
                                            </ul>
                                        </li>
                                        <li class="<?= isset($is_active) && $is_active == 'advertorial' ? 'current' : null; ?>"><a href="<?= Dee::createUrl('category/advertorial') ?>">Advertorial</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                            <!-- Main Menu End-->

                            <!-- Outer Box -->
                            <div class="outer-box clearfix">
                                <div class="search-box-btn"><span class="icon flaticon-magnifying-glass-1"></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Header Upper-->

            <!-- Mobile Menu  -->
            <div class="mobile-menu">
                <div class="menu-backdrop"></div>
                <div class="close-btn"><span class="icon flaticon-cancel"></span></div>

                <nav class="menu-box">
                    <div class="nav-logo"><a href="<?= Dee::createUrl('') ?>">
                            <img src="<?= Dee::createUrl('public/uploads/' . $web['logo']) ?>" alt="" title=""></a></div>
                    <ul class="navigation clearfix"><!--Keep This Empty / Menu will come through Javascript--></ul>
                    <!--Social Links-->
                    <div class="social-links">
                        <ul class="clearfix">
                            <li><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li><a href="#"><span class="fab fa-facebook-square"></span></a></li>
                            <li><a href="#"><span class="fab fa-pinterest-p"></span></a></li>
                            <li><a href="#"><span class="fab fa-instagram"></span></a></li>
                            <li><a href="#"><span class="fab fa-youtube"></span></a></li>
                        </ul>
                    </div>
                </nav>
            </div><!-- End Mobile Menu -->

        </header>
        <!-- End Main Header -->