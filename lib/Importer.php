<pre>
<?php
    include("Configuracion.php");


    function getImage($id){

        $db = Database::connect("mysql",null,null,null,"import_dondeir");
        $dbo = new Dbo();
        $util = new Utils();


        $sql = $dbo->select('wp_postmeta',"meta_key = '_thumbnail_id' AND post_id = '{$id}'");
        $query = $db->query($sql);
        $data = $util->queryArray($query);

        if(!empty($data)){

            $id2 = $data[0]['meta_value'];
            $sql = $dbo->select('wp_posts',"post_type = 'attachment' AND ID = '{$id2}'");
            $query = $db->query($sql);
            $data2 = $util->queryArray($query);

            if(!empty($data2)){
                return $data2[0]['guid'];
            }else{
                return "";
            }
        }


    }

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
        $sql2 = $dbo->select("wp_posts","post_type='restaurante'");
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
            $insertData['img_donde'] = getImage($r['ID']);

            $insert = $dbo->insert('marca',$insertData);

            print_r($insert);
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

//                    $upData['precios'] =  $extras['meta_value'];
//                    $sql = $dbo->update('marca',$upData,$id);

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
                echo $sql . " modificado <br />";
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

                        case  "_simple_fields_fieldGroupID_1_fieldID_4_numInSet_" . $cont:

                            $idPrecio = 1;
                            switch($v['meta_value']){

                                case "dropdown_num_2":
                                    $idPrecio = 1;
                                    break;
                                case "dropdown_num_3":
                                    $idPrecio = 2;
                                    break;
                                case "dropdown_num_4":
                                    $idPrecio = 3;
                                    break;
                                case "dropdown_num_5":
                                    $idPrecio = 4;
                                    break;
                            }

                            $d['id_precio'] = $idPrecio;

                            $msql = $dbo->update('marca',$d,$id);
                            $db1->query($msql);
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

                        case  "_simple_fields_fieldGroupID_1_fieldID_8_numInSet_" . $cont:

                            if(!empty($v['meta_value'])){

                                $zonas = unserialize($v['meta_value']);
                                $zona = $zonas[0];

                                $sqlZona = $dbo->select("wp_terms","term_id='{$zona}'");
                                $queryZona = $db2->query($sqlZona);
                                $dataZona = $util->queryArray($queryZona);

                                if(empty($dataZona))
                                    break;

                                $zonaName = $dataZona[0]['name'];

                                $sqlZonaNew = $dbo->select("zona","nombre='{$zonaName}'");
                                $queryZonaNew = $db1->query($sqlZonaNew);
                                $dataZonaNew = $util->queryArray($queryZonaNew);

                                if(empty($dataZonaNew)){

                                    $zonaInsert = array();
                                    $zonaInsert['nombre'] = $zonaName;
                                    $sqlZona = $dbo->insert('zona', $zonaInsert);
                                    $queryZona = $db1->query($sqlZona);
                                    $idZonaNew = $db1->insert_id;
                                    $insert['id_zona'] = $idZonaNew;


                                }else{
                                    $insert['id_zona'] = $dataZonaNew[0]['id'];
                                }


                            }

                            break;


                    }

                }

                $sqlInsert = $dbo->insert('sucursal',$insert);
                $db1->query($sqlInsert);

//                print_r($insert);

            }


            //print_r($data);
            $cont++;

        }

        //print_r($row2);

    }

    importMarcas();
    processMarcasSucursales();
?>
</pre>