<?php

class Cms
{

    public $db;
    public $util;
    public $dbo;

    function __construct()
    {

        $this->db = Database::connect();
        $this->dbo = new Dbo();
        $this->util = new Utils();

    }


    function getTitle($cuerpo = ""){

        $c = $cuerpo;
        $_cuerpo = explode('.',$cuerpo);
        $cuerpo = !empty($_cuerpo) ? $_cuerpo[0] : "";


        switch($cuerpo){

            case "apartments":
                $cuerpo = "Apartments";
                break;

            default:
                $tmp = $this->util->incluirSeccion($c);

                if($tmp == "404.php"){

                    $cuerpo = "404 not found";

                }else{

                    $cuerpo = $this->util->limpiarParams($cuerpo);

                }

                break;


        }

        echo $cuerpo;

    }


    function findContent($tag = ""){


        if(empty($tag))
            return "";

        $content = $this->dbo->select('cms',"tag = '{$tag}'",'cms_contenido as content');
        $query = $this->db->query($content);

        if(!$query)
            return "";

        $row = $query->fetch_array(MYSQL_ASSOC);

        return $row['content'];

    }

    function parseSection($content){

        preg_match_all('/{{(.*?)\}}/s', $content, $m);
        $wildcards = $m[1];

        foreach($wildcards as $w){


            switch($w){

                case "title_section":
                    $replace = "Title";
                    break;

                default:
                    $replace = $this->findContent($w);
                    break;

            }

            $content = str_replace('{{' . $w . '}}',$replace,$content);


        }

        echo $content;

    }

    function generateMenu(){

        $sql = $this->dbo->select("menu","","*","id_menu,posicion");
        $query = $this->db->query($sql);

        $data = array();
        while ($row = $query->fetch_array(MYSQL_ASSOC)) {
            $data[$row['id']] = $row;
        }

        $sql = $this->dbo->select("menu","id_menu IS NULL");
        $query = $this->db->query($sql);
        $row = $query->fetch_array(MYSQL_ASSOC);
        $idParent = $row['id'];

        echo $this->olLiTree($this->makeRecursive($data,$idParent));

    }

    function makeRecursive($d, $r = 0, $pk = 'id_menu', $k = 'id', $c = 'children') {
        $m = array();
        foreach ($d as $e) {
            isset($m[$e[$pk]]) ?: $m[$e[$pk]] = array();
            isset($m[$e[$k]]) ?: $m[$e[$k]] = array();
            $m[$e[$pk]][] = array_merge($e, array($c => &$m[$e[$k]]));
        }

        return $m[$r];
    }

    function olLiTree( $tree ) {

        if(!empty($tree)) echo '<ul class="nav navbar-nav navbar-right">';

        foreach ( $tree as $item ) {
            $u = explode("http",$item['url']);
            $url = "?s={$item['url']}";
            if(count($u) > 1){
                $url = $item['url'];
            }

            $active = "";
            if(!empty($_GET['s']) && $this->util->limpiarParams($_GET['s']) == $item['url']){
                $active = " class='active' ";
            }

            echo "<li $active id='{$item['id']}' parent_id='{$item['id_menu']}' > <a href='{$url}'>{$item['nombre']}</a>";
            if ( isset( $item['children'] ) ) {
                $this->olLiTree( $item['children'] );
            }
            echo "</li>";
        }
        if(!empty($tree)) echo '</ul>';
    }

}