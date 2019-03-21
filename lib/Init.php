<?php

$i = new Interceptor();
$w = new Wizard();
$w->init();
$isAjax = !empty($_GET['ajax']) ? $_GET['ajax'] : '';
$i->render($isAjax);
$u = new Utils();

