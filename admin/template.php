<?php $login = $u->loginSecurity();?>
<!doctype html>
	<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>:: efphp ADMIN ::</title>
		<meta name="description" content="efphp es un framework que sirve para poder hacer cualquier tipo de sistema, desde una página web hasta un sistema completo backend/frontend a la medida de manera rápida y muy muy sencilla. ">
		<meta name="author" content="Pedro Laris">
		<link rel="stylesheet" href="../css/reset.css">
        <link rel="stylesheet" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/dropzone.css">
        <link rel="stylesheet" href="../css/font-awesome.css">
        <link rel="stylesheet" href="../css/style_admin.css?v=1.0">
        <link rel="stylesheet" href="../css/data_table.css?v=1.0">
        <link rel="stylesheet" href="../css/jquery-ui.css?v=1.0">
        <link rel="stylesheet" href="../css/bootstrap-select.min.css">
        <link rel="stylesheet" href="../css/bootstrap3-wysihtml5.min.css">

        <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
        <link rel="icon" href="../favicon.ico" type="image/x-icon">

        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

            ga('create', '<?php echo GOOGLEANALYTICS;?>', 'auto');
            ga('send', 'pageview');

        </script>

	</head>
	<body <?php echo !empty($login) ? "class={$login}" : ""?>>
    <div class="page-wrap">
            <header>
                <?php
                $a = new Administrador();
                $a->controles();
                $title = $a->menu();
                $msj = new Messages();
                echo $msj->parseMessage($msj->getMessage());
                $msj->initMessages();
                ?>
            </header>
            <main>
                <?php
                if(!$a->renderAdmin($title))
                    include("vistas/" . $u->incluirSeccionAdmin($cuerpo));
                ?>
            </main>
        </div>
        <footer class="site-footer">
            <div id="disclaimer"><?php echo date("Y") . " - ";?> Powered by efphp</div>
        </footer>
        <script src="../js/jquery.js"></script>
        <script src="../js/bootstrap.js"></script>
        <script src="../js/dropzone.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/jquery.ajaxData.js"></script>
        <script src="../js/jquery.dataTables.min.js"></script>
        <script src="../js/lib.js"></script>
        <script src="../js/init.js"></script>
        <script src="../js/vistas_admin.js"></script>
        <script src="../js/bootstrap-select.min.js"></script>
        <script src="../js/wysihtml5x-toolbar.min.js"></script>
        <script src="../js/handlebars.runtime.min.js"></script>
        <script src="../js/bootstrap3-wysihtml5.min.js"></script>
        <script src="../js/jspdf.js"></script>

  </body>
</html>