<pre>
<?php
    include("Configuracion.php");

    function importMarcas(){

        $db1 = Database::connect();
        $db2 = Database::connect("mysql",null,null,null,"import_dondeir");

        $dbo = new Dbo();
        $util = new Utils();


        $sql1 = $dbo->select("marca");
        $query1 = $db1->query($sql1);
        $row = $util->queryArray($query1);


        $categoriaSql = $dbo->select("categoria");
        $queryCategoria = $db1->query($categoriaSql);
        $categoriaData = $util->queryArray($queryCategoria);
        $categorias = array();

        foreach($categoriaData as $c){

            $categorias[strtolower($c['nombre'])] = $c['id'];

        }



        //$sql2 = $dbo->select("wp_postmeta","post_id = 35");
        $sql2 = $dbo->select("wp_posts");
        $query2 = $db2->query($sql2);
        $row2 = $util->queryArray($query2);

        $insertData = array();


        foreach($row2 as $r){

            $insertData['nombre'] = ($r['post_title']);
            $insertData['wp_id'] = $r['ID'];
            $insertData['cms_resena'] = ($r['post_content']);
            $insertData['extracto'] = ($r['post_excerpt']);
            $insertData['firendlyurl'] = $r['post_name'];
            $insertData['id_categoria'] = (!empty($categorias[$r['post_type']])) ? $categorias[$r['post_type']] : $categorias['maincategory'];
            $insertData['id_categoria_vive'] = 1;
            $insertData['id_proyecto'] = 1;

            $insert = $dbo->insert('marca',$insertData);
            $db1->query($insert);

        }

        echo "Insertado correctamente.";

    }


    function processMarcasSucursales(){

        $db = Database::connect();
        $dbo = new Dbo();
        $util = new Utils();

        $sql = $dbo->select("marca");
        $query = $db->query($sql);
        $data = $util->queryArray($query);

        foreach($data as $d){

            importSucursales($d['id'],$d['wp_id']);
            echo "Inserción id = {$d['id']}, wp_id = {$d['wp_id']} ";
        }

    }

    function importSucursales($id, $wpId){

        $db1 = Database::connect();
        $db2 = Database::connect("mysql",null,null,null,"import_dondeir");

        $dbo = new Dbo();
        $util = new Utils();

        $sql1 = $dbo->select("marca","","id");
        $query1 = $db1->query($sql1);
        $marcas = $util->queryArray($query1);


        $sql2 = $dbo->select("wp_postmeta","post_id = '{$wpId}'");
        //$sql2 = $dbo->select("wp_postmeta","post_id = '63'");
        $query2 = $db2->query($sql2);
        $row2 = $util->queryArray($query2);

        /*
         * _precios -> precios
         * _simple_fields_fieldGroupID_1_fieldID_1_numInSet_0 -> nombre
         * _simple_fields_fieldGroupID_1_fieldID_2_numInSet_0 -> calle
         * _simple_fields_fieldGroupID_1_fieldID_3_numInSet_0 -> telefono
         * _simple_fields_fieldGroupID_1_fieldID_5_numInSet_0 -> latitud_longitud
         * _simple_fields_fieldGroupID_1_fieldID_6_numInSet_0 -> horarios
         *
         * */


        //especialidad
        //marca_especialidad
        /*
         * _comida -> comida
         * */

        //servicio
        //servicio_sucursal
        /*
         * código de vestimenta
         * forma de pago
         * detalles
         *
         * */

        $cont = 0;
        $flag = true;
        $upData = array();

        foreach($row2 as $extras){

            switch($extras['meta_key']){

                case "_precios":

                    $upData['precios'] =  $extras['meta_value'];
                    $sql = $dbo->update('marca',$upData,$id);

                    break;

                case "_comida":

                    $insert = array();
                    $insert['id_especialidad'] = '3';
                    $insert['id_marca'] = $id;
                    $insert['valor'] =  $extras['meta_value'];
                    $sql = $dbo->insert("marca_especialidad",$insert);

                    break;


            }

            if(!empty($sql)){
                $db1->query($sql);
                echo $sql . "<br />";
            }

            $sql = "";

        }

        while($flag){

            $key = "_simple_fields_fieldGroupID_1_fieldID_%_numInSet_" . $cont;
            $sql = $dbo->select('wp_postmeta',"post_id = '{$wpId}' AND meta_key LIKE '$key'");
            $query = $db2->query($sql);
            $data = $util->queryArray($query);
            echo "<br />-----------------------------<br /><br /><br /><br />";
            if(empty($data)){
                $flag = false;
                break;
            }else{
                $insert = array();
                $insert['id_marca'] = $id;
                $insert['img_fachada'] = "";
                foreach($data as $v){
//
//                    echo "<br />";
//                    print_r($v['meta_key']);
                    switch($v['meta_key']){

                        case "_precios":
                            $insert['precios'] = ($v['meta_value']);
                            break;
                        case  "_simple_fields_fieldGroupID_1_fieldID_1_numInSet_" . $cont:
                            $insert['nombre'] = ($v['meta_value']);
                            break;

                        case  "_simple_fields_fieldGroupID_1_fieldID_2_numInSet_" . $cont:
                            $insert['calle'] = ($v['meta_value']);
                            break;

                        case  "_simple_fields_fieldGroupID_1_fieldID_3_numInSet_" . $cont:
                            $insert['telefono'] = ($v['meta_value']);
                            break;

                        case  "_simple_fields_fieldGroupID_1_fieldID_5_numInSet_" . $cont:
                            $tmp = $v['meta_value'];
                            $l = explode(",",$tmp);
                            $insert['latitud'] = !empty($l[0]) ? $l[0] : "";
                            $insert['longitud'] = !empty($l[1]) ? $l[1] : "";
                            break;

                        case  "_simple_fields_fieldGroupID_1_fieldID_6_numInSet_" . $cont:
                            $insert['horarios'] = ($v['meta_value']);
                            break;


                    }

                }

                $sqlInsert = $dbo->insert('sucursal',$insert);
                echo $sqlInsert . "<br />";
                $db1->query($sqlInsert);

//                print_r($insert);

            }


            //print_r($data);
            $cont++;

        }

        //print_r($row2);

    }

    //importMarcas();
    //processMarcasSucursales();
?>
</pre>