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

    function findContent($tag = ""){


        if(empty($tag))
            return "";

        $content = $this->dbo->select('cms',"tag = '{$tag}'",'cms_contenido as content');
        $query = $this->db->query($content);

        if(!$query)
            return "";

        $row = $query->fetch_array(MYSQLI_ASSOC);

        return $row['content'];

    }

    function parseSection($content){

        preg_match_all('/{{(.*?)\}}/s', $content, $m);
        $wildcards = $m[1];


        foreach($wildcards as $w){

            $classArray = explode('class:',$w);

            if(count($classArray) > 1){

                $class = explode('->', $classArray[1])[0];
                $method = explode('->method:', $w)[1];

                $c = new $class();
                $c->$method();

            }


        }

        foreach($wildcards as $w){

            $replace = $this->findContent($w);
            $content = str_replace('{{' . $w . '}}',$replace,$content);

        }

        echo $content;

    }

    function generateMenu(){

        $sql = $this->dbo->select("menu","","*","id_menu,posicion");
        $query = $this->db->query($sql);

        $data = array();
        while ($row = $query->fetch_array(MYSQLI_ASSOC)) {
            $data[$row['id']] = $row;
        }

        $sql = $this->dbo->select("menu","id_menu IS NULL");
        $query = $this->db->query($sql);
        $row = $query->fetch_array(MYSQLI_ASSOC);
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

        if(!empty($tree)) echo '<ul>';

        foreach ( $tree as $item ) {
            echo "<li id='{$item['id']}' parent_id='{$item['id_menu']}' > <a href='?s={$item['url']}'>{$item['nombre']}</a>";
            if ( isset( $item['children'] ) ) {
                $this->olLiTree( $item['children'] );
            }
            echo "</li>";
        }
        if(!empty($tree)) echo '</ul>';
    }

}