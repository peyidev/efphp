<?php

class Dbo  {

    public $util;

    function __construct(){
        $this->util = new Utils();
    }

    function countRows(){

        return "SELECT FOUND_ROWS() as howmany;  ";

    }

    function orderBy($query, $columna){

        if(is_array($columna))
            $columna = implode(",",$columna);

        return $query . " ORDER BY " . $columna;
    }

    function where($query, $condicion){

        $condicion = $this->util->limpiar($condicion);

        return $query . " WHERE " . $condicion;
    }

    function searchQuery($tabla, $query){

        if(empty($tabla) || empty($query))
            return "";

        $tabla = $this->util->limpiar($tabla);
        $query = $this->util->limpiar($query);
        $extra = $this->createMultiJoin($tabla, $query);

        return "SELECT main_table.* {$extra['select']}
                    FROM {$tabla} as main_table {$extra['exp']} WHERE main_table.nombre
                    LIKE '%{$query}%' {$extra['where']} LIMIT 10";

    }

    function select($tabla, $where = "", $fields = "*", $order = "", $limit = null, $offset = null)
    {
        $tabla = $this->util->limpiar($tabla);
        $fields = $this->util->limpiar($fields);
        $order = $this->util->limpiar($order);
        $limit = $this->util->limpiar($limit);
        $offset = $this->util->limpiar($offset);

        $query = "SELECT SQL_CALC_FOUND_ROWS " . $fields . " FROM " . $tabla
            . (($where) ? " WHERE " . $where : "")
            . (($limit) ? " LIMIT " . $limit : "")
            . (($offset && $limit) ? " OFFSET " . $offset : "")
            . (($order) ? " ORDER BY " . $order : "");

        return $query;
    }

    function update($tabla, $formulario, $id){

        $llaves = "";
        $valores = "";

        foreach($formulario as $llave => $valor){

            if($llave == "password"){
                $valor = md5($valor);
            }

            if($llave != "id")
                $valores.="$llave ='" . $this->util->limpiar($valor) . "',";

        }

        $valores = substr($valores,0, (strlen($valores) - 1));

        return "UPDATE $tabla set $valores WHERE id='$id'";



    }

    function delete($tabla, $id){

        $id = $this->util->limpiar($id);
        return "DELETE FROM $tabla WHERE id = '$id'";

    }

    function selectAutoJoin($tabla, $id, $join = ""){

        if(empty($tabla))
            return "";

        $tabla = $this->util->limpiar($tabla);
        $extra = $this->createMultiJoin($tabla, "", $join);

        return "SELECT main_table.* {$extra['select']}
                    FROM {$tabla} as main_table {$extra['exp']} WHERE main_table.id = '{$id}'";

    }

    function insert($tabla, $data){

        $llaves = "";
        $valores = "";

        foreach($data as $llave => $valor){

            if($llave == "password"){
                $valor = md5($valor);
            }

            $llaves.="`$llave`,";
            $valores.="'" . $this->util->limpiar($valor) . "',";

        }
        $llaves = substr($llaves,0, (strlen($llaves) - 1));
        $valores = substr($valores,0, (strlen($valores) - 1));

        return "INSERT INTO $tabla ($llaves) VALUES ($valores)";



    }

    function tableExist($tabla){

        $sql = "SHOW TABLES LIKE '{$tabla}'";
        $query = Database::connect()->query($sql);

        if($query->num_rows == 1)
            return true;
        else
            return false;

    }

    function getColumns($tabla){

        $tabla = $this->util->limpiar($tabla);
        return "SHOW FULL COLUMNS FROM {$tabla}";
    }

    function createMultiJoin($table, $q = null, $join = ""){

        $sql = "DESCRIBE {$table}";
        $query = Database::connect()->query($sql);
        $exp = "";
        $select = "";
        $where = "";
        $res = array();
        $columns = array();
        $pdoexp = "";

        while($parent = $query->fetch_array(MYSQL_ASSOC)) {

            $foreign = explode("id_", $parent['Field']);
            if (count($foreign) > 1) {

                if ($this->tableExist($foreign[1])) {
                    $frg = $foreign[1];
                    $frg1 = $foreign[1] . "_f";
                    $exp .= " {$join} JOIN {$frg} ON {$frg}.id = main_table.id_{$frg} ";
                    $pdoexp .= " LEFT JOIN `{$frg}` as `{$frg1}` ON `{$frg1}`.`id` = `{$table}`.`id_{$frg}` ";
                    $select .= " {$frg}.nombre as {$frg}_nombre,";
                    $columns[] = "`{$frg}`.`nombre`";

                    if(!empty($q))
                        $where .= " OR {$frg}.nombre LIKE '%{$q}%'";

                }
            }

        }

        if(!empty($select)){
            $select = substr($select, 0, -1);
            $select = " , " . $select;
        }

        $res['exp'] = $exp;
        $res['dboexp'] = $pdoexp;
        $res['select'] = $select;
        $res['where'] = $where;
        $res['columns'] = $columns;

        return $res;
    }

    function ajaxSearch(){

        if(empty($_GET['q']))
            echo $this->util->errorJSON("Cadena Vacía");

        $table = $_GET['table'];
        $query = $_GET['q'];

        $sql = $this->searchQuery($table,$query);
        $query = Database::connect()->query($sql);
        $result = array();

        while($row = $query->fetch_array(MYSQL_ASSOC))
            $result[] = $row;

        echo $this->util->toJSON($result);


    }


    function unserializeForeign($val,$table){

        $data = array();

        if(!empty($val)){
            $data = @unserialize($val);
        }

        if(!empty($data)){

            $or = implode(" OR id=",$data);
            $or = "id=" . $or;

            $sql = $this->select($table,$or);
            return $sql;

        }else{

            return false;

        }

    }

}

