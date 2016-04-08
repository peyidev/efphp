<?php
require_once(realpath("../lib/Configuracion.php"));
?>
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


</head>
<body>

<div class="wrapper login-page">
    <?php
        $msj = new Messages();
        echo $msj->parseMessage($msj->getMessage());
        $msj->initMessages();
    ?>
    <div class="row mtop-100">
        <div class="col-md-4 col-md-offset-4 clearfix bg--dark">

            <div class="main-logo"><div id="logo-admin-block"><img id="logo-admin-img" src='../<?php echo LOGO;?>' alt='' /></div>

                <p>Welcome to Admin efphp</p>
            </div>
            <form method="post" id="login-form" action="../lib/Execute.php?e=User/loginAdmin">
                <div class="input-group">
                    <span class="input-group-addon"><i class="pe-7f-user pe-fw"></i></span>
                    <input type="text" class="input-text form-control" placeholder="Username" name="usr" />
                </div>
                <div class="input-group mtop-25">
                    <span class="input-group-addon"><i class="pe-7f-lock pe-fw"></i></span>
                    <input type="password" class="input-text form-control" placeholder="Password" name="psw" />
                </div>
                <div class="clearfix"></div>
                <a href="#"  id="submit-login" class="btn btn-skyblue pull-right">Login</a>
                <input type="submit" class="invisible" />
            </form>

        </div>
    </div>


</div> <!-- /wrapper -->
<!-- Scripts -->
<script type="text/javascript" src="../theme/levo/js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="../theme/levo/js/jquery-ui.js"></script>
<script type="text/javascript" src="../theme/levo/js/bootstrap.min.js"></script>
<script type="text/javascript">

    $('document').ready(function(){

        $('#submit-login').click(function(e){

            e.preventDefault();
            $('#login-form').submit();

        });

    });

</script>

</body>
</html>