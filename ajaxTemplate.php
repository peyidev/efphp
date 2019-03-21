<?php
if(!empty($_GET['json'])){
    //header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
}

$cms = new Cms();
$cms->parseSection(file_get_contents("vistas/" . $u->incluirSeccion($cuerpo)));



