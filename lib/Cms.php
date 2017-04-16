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


    function getConfiguration($key){

        $sql = $this->dbo->select('configuracion',"nombre = '{$key}'",'*');
        $query = $this->db->query($sql);
        $c = Utils::queryArray($query);

        return !empty($c[0]['valor']) ? $c[0]['valor'] : '';
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

    function sectionExistInMenu($section){

        $section = $this->util->limpiarParams($section);
        $sql = $this->dbo->select('menu',"url='{$section}'");
        $query = $this->db->query($sql);
        $row = Utils::queryArray($query);
        return !empty($row[0]) ? $row[0]['nombre'] : false;
    }

    function parseSection($content,$cuerpoLimpio){

        if($this->sectionExistInMenu($cuerpoLimpio)){
            $content .= "{{" . $cuerpoLimpio . "}}";
        }

        preg_match_all('/{{(.*?)\}}/s', $content, $m);
        $wildcards = $m[1];

        foreach($wildcards as $w){

            $replace = $this->findContent($w);
            $content = str_replace('{{' . $w . '}}',$replace,$content);

        }

        return $content;

    }

    function renderSection($cuerpo,$cuerpoLimpio){
        $cms = $this;
        eval('?>' . $this->parseSection(file_get_contents("vistas/" . $this->util->incluirSeccion($cuerpo)),$cuerpoLimpio)) . '<?php;';
    }


    function printHeadTitle($cuerpoLimpio){

        echo '<section class="main_title">
                    <div class="container">
                        <div class="row">
                            <div class="span12">
                                <h1>'. $this->sectionExistInMenu($cuerpoLimpio) .'</h1>
                            </div>
                        </div>
                    </div>
                </section>';

    }

    function generateMenu($mobile = false){

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

        echo $this->olLiTree($this->makeRecursive($data,$idParent),$mobile);

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

    function olLiTree( $tree, $mobile=false ) {

        $extra = '';
        if(empty($mobile))
            $extra = ' class="xxxx_menu" ';

        if(!empty($tree)) echo '<ul' . $extra . '>';

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