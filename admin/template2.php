<?php $u->loginSecurity();?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Levo Admin Theme</title>

    <link rel="apple-touch-icon" href="../theme/levo/touch-icon-iphone.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="../theme/levo/touch-icon-ipad.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="../theme/levo/touch-icon-iphone-retina.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="../theme/levo/touch-icon-ipad-retina.png" />
    <link rel="shortcut icon" type="image/x-icon" href="../theme/levo/favicon.ico" />

    <link href="../theme/levo/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="../theme/levo/css/font-awesome-4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../theme/levo/css/jquery-ui.css">
    <link rel="stylesheet" href="../theme/levo/jquery-jvectormap-1.2.2/jquery-jvectormap-1.2.2.css"/>
    <link href="../theme/levo/css/helper.css" rel="stylesheet" />
    <link href="../theme/levo/css/style.css" rel="stylesheet" />
    <link href="../theme/levo/css/particular.css" rel="stylesheet" />
    <link rel="stylesheet" href="../css/data_table.css?v=1.0">

</head>
<body>



<?php
$a = new Administrador();


$msj = new Messages();
echo $msj->parseMessage($msj->getMessage());
$msj->initMessages();
//if(!$a->renderAdmin($title))
//    include("vistas/" . $u->incluirSeccionAdmin($cuerpo));
?>

<header class="top-bar">
    <a class="mobile-nav" href="#"><i class="pe-7s-menu"></i></a>
    <?php $a->logo();?>
<!--    <div class="main-logo">Levo <span>Theme</span></div>-->
    <input type="checkbox" id="s-logo" class="sw" />
<!--    <label class="switch switch--dark switch--header" for="s-logo"></label>-->

    <div class="main-search">
        <input type="text" placeholder="Search for task, goal &amp; review" id="msearch">
        <label for="msearch">
            <i class="pe-7s-search"></i>
        </label>
    </div>
    <ul class="profile">
        <li>
            <a class="dropdown-toggle" data-toggle="dropdown" href="#" onclick="return false;" class="profile__user">
                <figure class="pull-left rounded-image profile__img">
                    <img class="media-object" src="../theme/levo/images/thumb0.jpg" alt="user">
                </figure>
                <?php $a->welcome();?>

            </a>
            <ul class="dropdown-menu pull-right">
                <li><a href="#"><i class="icon pe-7s-info pe-fw"></i> Edit Profile</a></li>
                <li><a href="#"><i class="icon pe-7s-date pe-fw"></i> My Calendar</a></li>
                <li><a href="../lib/Execute.php?e=User/logout&back=1"><i class="icon pe-7s-close-circle pe-fw"></i> Log Out</a></li>
            </ul>
        </li>
        <li class="profile--higlighted">
            <span class="badge profile__badge badge--red">8</span>
            <a class="dropdown-toggle" data-toggle="dropdown" onclick="return false;" href="#">
                <i class="pe-7f-mail"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li><a href="#"><i class="icon pe-7s-mail"></i> You have 8 unread messages</a></li>
            </ul>
        </li>
        <li class="profile--higlighted">
            <span class="badge profile__badge badge--red">5</span>
            <a class="dropdown-toggle" data-toggle="dropdown" onclick="return false;" href="#">
                <i class="pe-7f-drawer"></i>
            </a>
            <ul class="dropdown-menu pull-right">
                <li><a href="#"><i class="icon pe-7s-drawer"></i> You have 5 new notifications</a></li>
            </ul>
        </li>
        <li>
            <a href="#">
                <i class="pe-7f-config"></i>
            </a>
        </li>
    </ul>

</header> <!-- /top-bar -->

<div class="wrapper">

    <aside class="sidebar">

        <?php $title = $a->menu();?>
    </aside> <!-- /main-nav -->


    <section class="content">
        <header class="main-header clearfix">
            <h1 class="main-header__title">
                <i class="icon pe-7s-config"></i>
                Administración: <small><?php echo $title;?></small>
            </h1>
            <ul class="main-header__breadcrumb">
                <li><a href="#">Registros</a></li>
                <li class="active"><a href="#" class="add-new-record">Insertar nuevo registro</a></li>
            </ul>
            <div class="main-header__date">
                <i class="icon pe-7s-date"></i>
                <span><?php echo date("M d, Y");?></span>
                <i class="pe-7s-angle-down-circle"></i>
            </div>
        </header>

        <?php
        if(!$a->renderAdmin($title))
            include("vistas/" . $u->incluirSeccionAdmin($cuerpo));
        ?>

    </section> <!-- /content -->

    <footer class="main-footer">
        <a class="back-top" href="#"><i class="pe-7s-angle-up-circle"></i></a>
        <p><?php echo date("Y") . " - ";?> © Powered by efphp.</p>
    </footer>

</div> <!-- /wrapper -->


<!-- Scripts -->
<script type="text/javascript" src="../theme/levo/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../theme/levo/js/jquery-ui.js"></script>
<script type="text/javascript" src="../theme/levo/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../theme/levo/amcharts/amcharts.js"></script>
<script type="text/javascript" src="../theme/levo/amcharts/serial.js"></script>
<script type="text/javascript" src="../theme/levo/amcharts/pie.js"></script>
<script type="text/javascript" src="../theme/levo/js/chart.js"></script>
<script type="text/javascript" src="../theme/levo/js/map.js"></script>
<script src="../theme/levo/jquery-jvectormap-1.2.2/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../theme/levo/jquery-jvectormap-1.2.2/jquery-jvectormap-us-aea-en.js"></script>
<script type="text/javascript" src="../theme/levo/js/main.js"></script>

<script src="../js/jquery.ajaxData.js"></script>
<script src="../js/jquery.dataTables.min.js"></script>
<script src="../js/lib.js"></script>
<script src="../js/init.js"></script>
<script src="../js/vistas_admin.js"></script>


</body>
</html>