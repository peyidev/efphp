<?php

class Hairstyle
{

    public $db;
    public $util;
    public $dbo;
    public $user;
    public $showPrice;

    function __construct()
    {

        $this->db = Database::connect();
        $this->util = new Utils();
        $this->dbo = new Dbo();
        $this->user = new User();
        $this->showPrice = $this->getShowPrice();

    }


    function getShowPrice(){

        $sql = $this->dbo->select('configuracion',"nombre = 'PRECIOS_VISIBILIDAD'",'*');
        $query = $this->db->query($sql);
        $c = Utils::queryArray($query);

        return !!$c[0];

    }

    function categoryPage(){


        $sql = $this->dbo->select('categoria','','*','orden asc');
        $query = $this->db->query($sql);

        $c = Utils::queryArray($query);

        $firstCategory = $c[0]['id'];

        $catId = !empty($_GET['category']) ? $_GET['category'] : $firstCategory;

        echo $this->getProducts($catId);
        echo $this->getCategories($c, $catId);



    }

    function getPrecio($row){

        $precio = '';

        if(!empty($row['precio_promocion'])){
            $precio .= '<span><p style="text-decoration: line-through;">$' .  money_format('%(#10n', $row['precio']) . '</p></span>';
            $precio .= '<span><p>$' .  money_format('%(#10n', $row['precio_promocion']) . '</p></span>';
        }else{
            $precio .= '<span><p>&nbsp;</p></span>';
            $precio .= '<span><p>$' .  money_format('%(#10n', $row['precio']) . '</p></span>';
        }

        return $precio;
    }

    function getCategories($c, $selected){


        $categories = '';
        $description = '';

        foreach($c as $row){

            $current = ($row['id'] == $selected) ? 'class="current"' : '';
            if(!empty($current)){
                $description = $row['cms_descripcion'];
            }

            $categories .= '<li><a ' . $current . '  href="?s=servicios&category=' . $row['id'] . '" >' . $row['nombre'] . '</a></li>';
        }




        $categories = '<div class="sidebar">
                <div class="widget_block">
                    <div class="service_cat">
                        <header><span>Nuestros servicios</span></header>
                        <nav>
                            <ul>' . $categories . '</ul>
                        </nav>
                    </div>


                </div>

                <div class="widget_block">
                    <div class="xx_text">
                        <p>' . $description . '</p>
                    </div>
                </div>
            </div>';

        return $categories;
    }

    function getProducts($category){

        $sql = $this->dbo->select('servicio',"id_categoria = {$category} AND bool_visible = 1",'*','orden asc');
        $query = $this->db->query($sql);

        $p = Utils::queryArray($query);

        $productsEmpty = '<div style="width:100%;text-align: center;">No existen servicios asociados a esta categoria</div>';
        $products = '';
        $cont = 0;

        foreach($p as $row){

            $cont++;

            $price = '';
            if($this->showPrice)
                $price = '<span><p>' . $this->getPrecio($row) . '</p></span>';

            $products .= '<li class="curly medium">
                                <a href="#">
                                    <img src="' . $row['img_foto'] . '" alt="' . $row['nombre'] . '" />
                                    <span>' . $row['nombre'] . '</span>
                                    ' . $price . '
                                </a>
                            </li>';
        }

        $products = ($cont == 0) ? $productsEmpty : '<ul class="service-list">' . $products . '</ul>';

        $products = '<div class="span9 fix right">

                <!-- SERVICES -->
                <section class="xx_content">
                    <div class="services">
                        <header class="content_header">
                            <div class="filter">

                                <div class="item_counter">
                                    <span>Servicios disponibles</span>
                                    <span class="count">' . $cont . '</span>
                                </div>
                            </div>
                           
                        </header>                        
                        ' . $products . '
                    </div>
                </section>
                <!-- /SERVICES -->

            </div>
';
        return $products;

    }

    function promocionesPage(){

        $sql = $this->dbo->select('promocion','bool_activa = 1','*','orden asc');
        $query = $this->db->query($sql);

        $p = Utils::queryArray($query);

        $head = '';
        $body = '';

        foreach($p as $row){

            $head .= '<li><a href="#tabs' . $row['id'] . '">' . $row['nombre'] . '</a></li>';
            $body .= '<div id="tabs' . $row['id'] . '">
                                    <div class="img_holder">
                                        <img alt="" src="' . $row['img_promo'] . '">
                                    </div>
                                    <div class="content_holder">
                                        <h4>' . $row['nombre'] . '</h4>
                                        <p>' . $row['cms_descripcion'] . '</p>
                                    </div>
                                    <a href="#" class="read_more">Vigencia: ' . $row['vigencia'] . '</a>
                        </div>';

        }

        $promociones = '<div class="serviceIntro">
                            <ul class="etabs">
                               ' . $head . '
                            </ul>
                            <div class="tabcontent">
                              ' . $body . '
                            </div>
                        </div>';

        echo $promociones;


    }

    function getSliderHome(){

        $sql = $this->dbo->select('slider','bool_activa = 1','*','orden asc');
        $query = $this->db->query($sql);

        $p = Utils::queryArray($query);
        $slides = '';

        foreach($p as $row){

            $slides .= ' <li>
                            <img alt="" src="' . $row['img_foto'] . '">
                                    <div class="infobox">
                                        <h4>' . $row['nombre'] . '<br></h4>
                                        <p>' . $row['cms_descripcion'] . '</p>
                                    </div>
                         </li>';
        }


        $slider = '<section class="main_slider x_slider">
                        <div class="flexslider">
                            <ul class="slides">
                               ' . $slides . '
                            </ul>
                        </div>
                    </section>';

        return $slider;


    }

    function getServiciosHome(){

        $sql = $this->dbo->select('serviciowidget','bool_activa = 1','*','orden asc');
        $query = $this->db->query($sql);

        $p = Utils::queryArray($query);

        $head = '';
        $body = '';

        foreach($p as $row){

            $head .= '<li><a href="#tabs' . $row['id'] . '">' . $row['nombre'] . '</a></li>';
            $body .= '<div id="tabs' . $row['id'] . '">
                                    <div class="img_holder">
                                        <img alt="" src="' . $row['img_promo'] . '">
                                    </div>
                                    <div class="content_holder">
                                        <h4>' . $row['nombre'] . '</h4>
                                        <p>' . $row['cms_descripcion'] . '</p>
                                    </div>
                        </div>';

        }

        $promociones = '<div class="serviceIntro">
                            <ul class="etabs">
                               ' . $head . '
                            </ul>
                            <div class="tabcontent">
                              ' . $body . '
                            </div>
                        </div>';

        return $promociones;


    }

    function getTestimoniosHome(){

        $sql = $this->dbo->select('testimonio','','*','orden asc');
        $query = $this->db->query($sql);

        $t = Utils::queryArray($query);
        $testimonio = '';

        foreach($t as $row){

            $testimonio .= '<div class="carousel-item">
                            <div class="xx_b">
                                <p>' . $row['cms_descripcion'] . '</p>
                            </div>
							<img alt="" src="' . $row['img_foto'] . '" class="testimonials-img">
                            <span class="t_author">' . $row['nombre'] . '</span> ' . $row['servicio'] . '
                        </div>';

        }

        $testimonios = '<div class="testimonials">
                            <span class="title">Algunos comentarios de nuestros clientes</span>
                            <div class="carouselle">
                                    ' . $testimonio . '
                            </div>
                        </div>';


        return $testimonios;

    }

    function getArticulosTendencias(){

        $sql = $this->dbo->select('articulo','','*','id desc');
        $query = $this->db->query($sql);

        $t = Utils::queryArray($query);
        $articulos = '';

        $cont = 1;
        foreach($t as $row){

            $class = ($cont % 2 == 0) ? 'tendencias-right' : 'tendencias-left';
            $leerMas = !empty($row['bool_leermas']) ? '<p><a href="?s=articulo&id=' . $row['id'] . '" class="modal_button">Leer Más</a></p>' : '';

            $cont++;
            $articulos .= ' <article class="tendencias ' . $class . '">
                    <div class="tendencias-resumen"  class="content_holder desc">
                        <div class="title_holder">
                            <h4>' . $row['nombre'] . '</h4>
                            <p class="meta"><span>Tendencias  /  ' . $row['fecha'] . '</span></p>
                        </div>
                        <p>
                            ' . $row['cms_resumen'] . '
                        </p>
                        ' . $leerMas . '
                    </div>
                    <img class="tendencias-img" src="' . $row['img_resumen'] . '" />
                    <div class="clearfix"></div>
                </article>';

        }



        return $articulos;


    }

}