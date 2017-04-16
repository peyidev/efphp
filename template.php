<?php $cms = new Cms(); ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<!-- http://preview.themeforest.net/item/haircut-barbershop-spa-beauty-manicure-html-template/full_screen_preview/9946680?_ga=1.246651460.1571185123.1488204745  SPLIT ENDS-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="description" content="Haircut - Clean HTML5 and CSS3 responsive template">
    <meta name="author" content="Themedo">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <title>Haircut - Responsive HTML5 and CSS3 template</title>

    <link rel="shortcut icon" href="theme/haircut/theme/haircut/img/favicon.ico" />

    <!-- STYLES -->
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/fontello.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/flexslider.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/skeleton.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/owl.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/magnific.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/base.css" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/colors.php" />
    <link rel="stylesheet" type="text/css" href="theme/haircut/css/style.css" />
    <!--[if lt IE 9]><link rel="stylesheet" type="text/css" href="theme/haircut/css/ie.css" /><![endif]-->

    <!--[if lt IE 9]> <script type="text/javascript" src="js/modernizr.custom.js"></script> <![endif]-->
</head>

<body>



<!-- CONTENT -->
<div class="contentwrap">


    <!-- HEADER -->
    <header class="header">
        <div class="container">
            <div class="row">
                <div class="span12">

                    <!-- LOGO -->
                    <div class="logo_wrap">
                        <a href="index.html"><img src="theme/haircut/img/logo.png" alt="estudio805" /></a>
                    </div>
                    <!-- /LOGO -->

                    <div class="head_right">

                        <!-- OPENING TIME -->
                        <div class="opening_time">
                            <a class="working_day" href="theme/haircut/modal/opening.html" data-effect="xx-zoom-out">
                                <img src="theme/haircut/svg/opentime.svg" alt="barbershop"/>
                                <span class="open">Lunes - Viernes:  10.00 - 19.00</span>
                                <span class="open">Sábado:  10.00 - 17.00</span>
                                <span class="close">Domingo: Cerrado</span>
                            </a>
                        </div>
                        <!-- /OPENING TIME -->

                        <!-- BOOK ONLINE -->
                        <div class="book_online">
                            <a class="book_button" href="theme/haircut/modal/book.html" data-effect="xx-zoom-out">Agenda tu cita</a>
                            <a class="address_button gradient" href="theme/haircut/modal/address.html" data-effect="xx-zoom-out"><i class="xcon-location"></i></a>
                        </div>
                        <!-- /BOOK ONLINE -->

                        <!-- MOBILE NAV TRIGGER -->
                        <div class="nav_trigger">
                            <a href="#">
                                <span class="icono">
                                    <span class="sp_a"></span>
                                    <span class="sp_b"></span>
                                    <span class="sp_c"></span>
                                </span>
                            </a>
                        </div>
                        <!-- /MOBILE NAV TRIGGER -->
                    </div>

                    <!-- MOBILE NAV -->
                    <div class="nav_mobile">
                        <?php $cms->generateMenu("mobile");?>
                    </div>
                    <!-- /MOBILE NAV -->


                    <!-- MAIN NAV -->
                    <nav class="navigation" data-sticky="off">
                        <?php $cms->generateMenu();?>
                    </nav>
                    <!-- /MAIN NAV -->

                </div>
            </div>
        </div>
    </header>
    <!-- /HEADER -->


    <main>
        <!-- NO MODIFICAR ESTA PARTE SI NECESITAS SECCIONES "ESTÁTICAS" INICIO-->
        <?php $cms->renderSection($cuerpo,$cuerpoLimpio); ?>
        <!-- NO MODIFICAR ESTA PARTE SI NECESITAS SECCIONES "ESTÁTICAS" FIN-->
    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="span12">

                    <a href="#totop" class="totop">
                        <span class="xx_aa"><i class="xcon-angle-double-up"></i></span>
                        <span class="xx_bb"></span>
                        <span class="xx_cc"></span>
                    </a>

                    <ul class="social">
                        <li><a href="#" target="_blank"><span><i class="xcon-facebook"></i></span>Facebook</a></li>
                        <li><a href="#" target="_blank"><span><i class="xcon-twitter"></i></span>Twitter</a></li>
                        <li><a href="#" target="_blank"><span><i class="xcon-instagram"></i></span>Instagram</a></li>
                        <li><a href="#" target="_blank"><span><i class="xcon-pinterest"></i></span>Pinterest</a></li>
                        <li><a href="#" target="_blank"><span><i class="xcon-gplus"></i></span>Google+</a></li>
                    </ul>


                    <p class="copyright">Copyright &copy; 2017 <a href="#">Estudio 805</a></p>

                </div>
            </div>
        </div>
    </footer>
    <!-- /FOOTER -->

</div>
<!-- / CONTENT -->



<!-- SCRIPTS -->
<script type="text/javascript" src="theme/haircut/js/jquery.js"></script>
<script type="text/javascript" src="theme/haircut/js/plugins.js"></script>
<script type="text/javascript" src="theme/haircut/js/xxxx.js"></script>

</body>
</html>
