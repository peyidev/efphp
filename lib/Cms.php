<?php

class Cms
{

    public $db;
    public $util;

    function __construct()
    {

        $this->db = Database::connect();
        $this->util = new Utils();

    }

    function parseSection($content){

        echo $content;

    }

    function generateMenu(){

        $sql = $this->util->select("menu");
        $order = ['id_menu','posicion'];
        $sql = $this->util->orderBy($sql,$order);
        $query = $this->db->query($sql);

        $data = array();
        while ($row = $query->fetch_array(MYSQL_ASSOC)) {
            $data[$row['id']] = $row;
        }

        $sql = $this->util->select("menu");
        $sql = $this->util->where($sql,"id_menu IS NULL");
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