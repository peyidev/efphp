<?php $cms = new Cms(); ?>
<!doctype html>

	<html lang="es">
	<head>
		<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<title>:: efphp ::</title>
        <meta name="description" content="efphp es un framework que sirve para poder hacer cualquier tipo de sistema, desde una página web hasta un sistema completo backend/frontend a la medida de manera rápida y muy muy sencilla. ">
		<meta name="author" content="Pedro Laris">
		
		<link rel="stylesheet" href="css/reset.css">
        <link rel="stylesheet"href="css/bootstrap.css">
        <link rel="stylesheet"href="css/font-awesome.css">
        <link rel="stylesheet" href="css/data_table.css?v=1.0">
        <link rel="stylesheet" href="css/jquery-ui.css?v=1.0">
        <link rel="stylesheet" href="css/bootstrap-select.min.css">
        <link rel="stylesheet" href="css/bootstrap3-wysihtml5.min.css">
		<link rel="stylesheet" href="css/style.css?v=1.0">

        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">



    </head>
	<body>

        <div class="page-wrap">

            <header>
                HEADER
            </header>

            <main>
                CONTENT
                <!-- NO MODIFICAR ESTA PARTE SI NECESITAS SECCIONES "ESTÁTICAS" INICIO-->
                <?php $cms->parseSection(file_get_contents("vistas/" . $u->incluirSeccion($cuerpo))); ?>
                <!-- NO MODIFICAR ESTA PARTE SI NECESITAS SECCIONES "ESTÁTICAS" FIN-->
            </main>

        </div>

        <footer class="site-footer">
            FOOTER
        </footer>

        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/jquery-ui.min.js"></script>
        <script src="js/jquery.ajaxData.js"></script>
        <script src="js/bootstrap-select.min.js"></script>
        <script src="js/lib.js"></script>
        <script src="js/init.js"></script>
        <script src="js/vistas.js"></script>

	</body>
	
</html>