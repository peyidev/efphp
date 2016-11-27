<?php $cms = new Cms(); ?>
<!doctype html>

	<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Home | MHM Properties</title>
        <link href="css/bootstrap.min.css"     rel="stylesheet">
        <link href="css/font-awesome.min.css"  rel="stylesheet">
        <link href="css/animate.min.css"       rel="stylesheet">
        <link href="css/lightbox.css"          rel="stylesheet">
        <link href="css/main.css"              rel="stylesheet">
        <link href="css/responsive.css"        rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="images/ico/favicon.png">
        <!--<link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">-->
        <!--<link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">-->
        <!--<link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">-->
        <!--<link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">-->

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo GOOGLEANALYTICS;?>', 'auto');
            ga('send', 'pageview');

        </script>


    </head>
	<body>

    <!--class="inner-pages" option IN PAGES-->
    <header id="header" class="inner-pages">
        <div class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">
                        <h1><img src="images/logoWhite.png" alt="logo"></h1>
                    </a>
                </div>
                <div class="collapse navbar-collapse">
                    <div class="nav nav-header-top navbar-right">
                        <i class="fa fa-location-arrow"></i><span class="span-sm-size">Champaign Urbana, IL</span>
                        <span class="span-sm-pipe">|</span>
                        <i class="fa fa-envelope"></i><span class="span-sm-size">contact@mhmproperties.com</span>
                        <label class="navbar-right">CALL US: <strong><i>(217) </i> 337-8852</strong></label>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="?s=home">HOME</a></li>
                        <li><a href="?s=apartments ">APARTMENTS</a></li>
                        <li><a href="?s=houses ">HOUSES</a></li>
                        <li><a href="?s=condos ">CONDOS</a></li>
                        <li><a href="?s=resources ">RESOURCES</a></li>
                        <li><a href="?s=404 ">404</a></li>
                        <li><a href="?s=contact">CONTACT US</a></li>
                        <li><a href="https://mhmprop.twa.rentmanager.com/ " target="_blank">
                                <span class="tenant"><span>TENANT </span>LOG IN</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>



        <div class="inner-pages-container inner-header-<?php $cms->getTitle($cuerpo);?>">
            <img src="images/inner-pages.jpg" alt="">
            <div class="in-page-all in-pages">
                <h1 class="page_title"><?php $cms->getTitle($cuerpo);?></h1>
            </div>
        </div>
    </header>


    <?php $cms->parseSection(file_get_contents("vistas/" . $u->incluirSeccion($cuerpo))); ?>



    <footer id="footer">
        <div class="container p-t-lg">
            <div class="row">
                <div class="col-md-4 col-sm-6">
                    <div class="testimonial bottom">
                        <h2 class="h2-white">MENU</h2>
                        <div class="media">
                          <a href="?s=home"><label>HOME</label></a><br>
                          <a href="?s=apartments"><label>APARTMENTS</label></a><br>
                          <a href="?s=houses"><label>HOUSES</label></a><br>
                          <a href="?s=condos"><label>CONDOS</label></a><br>
                          <a href="?s=resources"><label>RESOURCES</label></a><br>
                          <a href="?s=contact"><label>CONTACT US</label></a><br>
                            <label><a><span class="tenant"><span>TENANT </span>LOG IN</span></a></label>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-sm-6">
                    <div class="contact-form bottom">
                        <h2 class="h2-white">Contact us</h2>
                        <form id="main-contact-form" name="contact-form" method="post" action="sendemail.php">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" required="required" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <input type="email" name="email" class="form-control" required="required" placeholder="Email Id">
                            </div>
                            <div class="form-group">
                                <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="submit" name="submit" class="btn btn-submit" value="Submit">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="contact-info bottom">
                        <h2 class="h2-white">Contacts</h2>
                        <address>
                            E-mail: <a href="mailto:contact@mhmproperties.com">contact@mhmproperties.com</a> <br>
                            Phone #1: +1 (217) 337 8852 <br>
                            Phone #2: +1 (217) 841 5407 <br>
                            Facsimile: +1 (217) 841 5407 <br>
                        </address>
                        <h2>Address</h2>
                        <address>
                            303 S Fifth Street Champaign, IL 61820 <br>
                            MAILING ADDRESS:  MHM Properties and Management P.O. Box 5054 Champaign, IL 61825 <br>
                            <a href="www.mhmproperties.com">www.mhmproperties.com </a><br>
                        </address>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="col-sm-12">
                <div class="copyright-text text-center">
                    <p>&copy; MHM Properties 2016. All Rights Reserved.</p>
                    <p>Crafted by <a target="_blank" href="http://www.silverip.com/">SilverIP</a></p>
                </div>
            </div>
        </div>
    </footer>
    <!--/#footer-->

    <!--
        <section id="features">
            <div class="container">
                <div class="row">
                    <div class="single-features">
                        <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                            <img src="images/home/image1.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                            <h2>Experienced and Enthusiastic</h2>
                            <P>Pork belly leberkas cow short ribs capicola pork loin. Doner fatback frankfurter jerky meatball pastrami bacon tail sausage. Turkey fatback ball tip, tri-tip tenderloin drumstick salami strip steak.</P>
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="col-sm-6 col-sm-offset-1 align-right wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                            <h2>Built for the Responsive Web</h2>
                            <P>Mollit eiusmod id chuck turducken laboris meatloaf pork loin tenderloin swine. Pancetta excepteur fugiat strip steak tri-tip. Swine salami eiusmod sint, ex id venison non. Fugiat ea jowl cillum meatloaf.</P>
                        </div>
                        <div class="col-sm-5 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                            <img src="images/home/image2.png" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="single-features">
                        <div class="col-sm-5 wow fadeInLeft" data-wow-duration="500ms" data-wow-delay="300ms">
                            <img src="images/home/image3.png" class="img-responsive" alt="">
                        </div>
                        <div class="col-sm-6 wow fadeInRight" data-wow-duration="500ms" data-wow-delay="300ms">
                            <h2>Experienced and Enthusiastic</h2>
                            <P>Ut officia cupidatat anim excepteur fugiat cillum ea occaecat rump pork chop tempor. Ut tenderloin veniam commodo. Shankle aliquip short ribs, chicken eiusmod exercitation shank landjaeger spare ribs corned beef.</P>
                        </div>
                    </div>
                </div>
            </div>
        </section>
         <!--/#features-->

    <!--/#clients-->




    <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/jquery.ajaxData.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-select.min.js"></script>
        <script type="text/javascript" src="js/lightbox.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script type="text/javascript" src="js/gmaps.js"></script>
        <script type="text/javascript" src="js/wow.min.js"></script>
        <script type="text/javascript" src="js/main.js"></script>
        <script type="text/javascript" src="js/jquery.isotope.min.js"></script>
        <script type="text/javascript" src="js/js.js"></script>
        <script type="text/javascript" src="js/lib.js"></script>
        <script type="text/javascript" src="js/init.js"></script>
        <script type="text/javascript" src="js/vistas.js"></script>

	</body>
	
</html>