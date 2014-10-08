<?php
	
	class Administrador{
		
		public $mysqli;

		function __construct($mysqli){
			
			$this->mysqli = $mysqli;

		}
		
		function loginAdmin(){

			$u = new Utils();
			$usr = $u->limpiarParams($_REQUEST['usr']);
			$psw = $u->limpiarParams($_REQUEST['psw']);
			$sql = "SELECT a.*, r.nombre as rolNombre FROM admin a, rol r WHERE email = '$usr' AND password = '$psw'
					AND a.id_rol = r.id";
			$query = $this->mysqli->query($sql);
			$row = $query->fetch_array(MYSQL_ASSOC);

			if(!empty($row)){
				
				$_SESSION["id_admin"] = $row['id'];
				$_SESSION["nombre"] = $row['nombre'];
				$_SESSION["rol"] = $row['rolNombre'];
				
			}
			
		}
		
        function tableExist($tabla){

            $sql = "SHOW TABLES LIKE '%{$tabla}%'";
            $query = $this->mysqli->query($sql);

            if($query->num_rows == 1)
                return true;
            else
                return false;

        }

		function renderAdmin(){

            $tabla = "";
            $u = new Utils();

            if(!empty($_GET['s'])){

                $tabla = $_GET['s'];
                $tabla = explode("-", $tabla);

                if(count($tabla) > 1){
	
					echo "<div class='admin-generic'>";
                    switch($tabla[1]){

                        case "admin":
                            echo "<div class='admin-left-column'>";
                                $this->createAdminTable($tabla[0]);
                            echo "</div>";

                            echo "<div class='admin-right-column'>";
                            $this->createGrid($tabla[0]);
                            echo "</div>";
                        break;

                        case "update":

                            $id = $_GET['id'];
                            echo "<div class='admin-left-column'>";
                                $this->createUpdateForm($tabla[0],$id);
                            echo "</div>";

                            echo "<div class='admin-right-column'>";
                            $this->createGrid($tabla[0]);
                            echo "</div>";

                        break;

                        case "report":
							$this->createGrid($tabla[0],"report");
                        break;

						case "detail":
							$detail = $_GET['s'];
							$detail = explode("-",$detail);
							$detail = $detail[0];
							include(BASE_PATH . ADMINURL . "reportes/{$detail}.php");
						break;



                    }

					echo "</div>";
                }else{


                    include("../admin/vistas/home.php");

                }


                }


        }


		function controles(){
			
			if(!empty($_SESSION['id_admin'])){
				
				echo "<div id='general-controls'>
					<p>Bienvenido:" . $_SESSION['nombre'] . "</p>
					<a href='../lib/Execute.php?e=User/logout&back=1'>Salir</a>
				</div>";
				
			}
			
		}
		
		function menu(){
			
			if(!empty($_SESSION['id_admin'])){
				
				$xml=simplexml_load_file(BASE_PATH . ADMINURL . "config/menu.xml");
				

				$menu = "<ul id='main-menu'>";
				
				for($i = 0; $i < count($xml->item); $i++){
					
					$rolSize = count($xml->item[$i]->rol);

					if($rolSize > 0){
						
						foreach($xml->item[$i]->rol as $rol){

							if($rol == $_SESSION["rol"]){
								
								$menu.="<li class='menu-item'><a href='{$xml->item[$i]->itemLink}' class='menu-item-link'>{$xml->item[$i]->itemName}</a>";
									
									if(count($xml->item[$i]->subitem) > 0){
										$menu.= "<ul>";
										foreach($xml->item[$i]->subitem as $subitem){

											$menu .= "<li class='submenu-item'><a href='{$subitem->subitemLink}' class='menu-subitem-link'>" . $subitem->subitemName . "</a></li>";

										}
										$menu.= "</ul>";
									}

									
								$menu.="</li>";
								
							}
							
						}
						
					}
					
				}
				
				$menu .= "</ul>";
				echo $menu;
			}
			
		}
		
		function deleteRow(){
			
			$u = new Utils();
			$table = $_GET['table'];
			$id = $_GET['id'];
			$sql = $u->generarDelete($table, $id);
            $query = $this->mysqli->query($sql);
            echo $u->mensajeJSON("1");
		}
		
		function updateRow(){
			
            $table = $_GET['table-insert'];
			$id = $_GET['id'];
            $u = new Utils();
            $sql = $u->generarUpdate($table,$_POST,$id);
            echo $sql;
            $query = $this->mysqli->query($sql);
            return true;			
			
		}

        function insertRow(){

            $table = $_GET['table-insert'];
            $u = new Utils();
            $sql = $u->generarInsert($table,$_POST);
            echo $sql;
            $query = $this->mysqli->query($sql);
            return true;

        }

        function createGrid($tabla,$report = false){

            $sql = "SELECT * FROM {$tabla}";
            $query = $this->mysqli->query($sql);
			$columns = "";
			$tbody = "";
			$thead = "";
			$flag = true;
			$controles = "";

			
			if($report){
				$controles .= "<th>Consultar</th>";
			}else{
				$controles .= "<th>Editar</th><th>Eliminar</th>";
			}
			

			
			
			$sqlRow = "DESCRIBE {$tabla}";
            $queryRow = $this->mysqli->query($sqlRow);

			
            while ($rowRow = $queryRow->fetch_array(MYSQL_ASSOC)) {
                $columns[] = $rowRow;
            }
			

			
            while($row = $query->fetch_array(MYSQL_ASSOC)){
				
				$tbody .= "<tr>";
				$id = "";
				
				for($i = 0; $i < count($columns); $i++){
					
					if($flag){
						
						$thead .= "<th>" . $columns[$i]["Field"] . "</th>";
						
					}
					
					if($columns[$i]["Field"] == "id"){
						
						$id = $row[$columns[$i]["Field"]];
						
					}
					
					$tbody .= "<td>" . $row[$columns[$i]["Field"]] . "</td>";
					
				}
				
				$flag = false;
				
				if($report){
					$tbody .= "	<td style='text-align:center;'>
									<a href='?s={$tabla}-detail&id={$id}'><img src='../css/img/consulta.png' /></a>
								</td>
							</tr>";					
					
					
				}else{
					$tbody .= "	<td style='text-align:center;'>
									<a href='?s={$tabla}-update&id={$id}'><img src='../css/img/editar.png' /></a>
								</td>
								<td style='text-align:center;'>
									<a href='?s={$tabla}&id={$id}' class='delete-admin'><img src='../css/img/eliminar.png' /></a>
								</td>
							</tr>";					
					
				}

				
            }

			echo "<table class='table-admin'>
					<thead><tr>{$thead}{$controles}</tr></thead>
					<tfoot><tr>{$thead}{$controles}</tr></tfoot>
					<tbody>{$tbody}</tbody>
				</table>";

        }

        function createUpdateForm($tabla, $id){

            echo '<form action="../lib/Execute.php?e=Administrador/updateRow&table-insert=' . $tabla . '&id=' . $id . '&back=1" method="post"
enctype="multipart/form-data">';

            $sql = "DESCRIBE {$tabla}";
            $query = $this->mysqli->query($sql);

            $sqlInfo = "SELECT * FROM {$tabla} WHERE id='{$id}'";
            $infoQuery = $this->mysqli->query($sqlInfo);
            $info = $infoQuery->fetch_array(MYSQL_ASSOC);


            $data = array();
            while ($row = $query->fetch_array(MYSQL_ASSOC)) {
                $data[] = $row;
            }

            foreach($data as $row){

                if($row['Field'] != "id"){

                    $foreign = explode("id_",$row['Field']);
                    $img = explode("img_",$row['Field']);
                    $flag = true;

                    if(count($foreign) > 1){

                        if($this->tableExist($foreign[1])){

                            $sqlForeign = "SELECT * FROM {$foreign[1]}";
                            $queryForeign = $this->mysqli->query($sqlForeign);
                            $combo = "";

                            while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ){

                                $selected = "";

                                if($rowForeign['id'] == $info[$row['Field']]){

                                    $selected = " selected=selected";

                                }

                                $combo.="<option value='{$rowForeign['id']}' {$selected}>{$rowForeign['nombre']}</option>";

                            }

                            echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><select name='{$row['Field']}'>{$combo}</select></p>
                              </div>";

                            $flag = false;

                        }


                    }else if(count($img) > 1){
                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><input type='file' name='{$row['Field']}' class='{$row['Type']}' /></p>
                              </div>";
                        $flag = false;
                    }


                    if($flag){
                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><input type='text' name='{$row['Field']}' class='{$row['Type']}' value='{$info[$row['Field']]}' /></p>
                              </div>";
                    }



                }

            }

            echo '<input type="submit" value="Actualizar"/>';
            echo '</form>';

        }

        function createAdminTable($tabla){


            echo '<form action="../lib/Execute.php?e=Administrador/insertRow&table-insert=' . $tabla . '&back=1" method="post"
enctype="multipart/form-data">';

            $sql = "DESCRIBE {$tabla}";
            $query = $this->mysqli->query($sql);

            $data = array();
            while ($row = $query->fetch_array(MYSQL_ASSOC)) {
                $data[] = $row;
            }

            foreach($data as $row){

                if($row['Field'] != "id"){

                    $foreign = explode("id_",$row['Field']);
                    $img = explode("img_",$row['Field']);
                    $flag = true;

                    if(count($foreign) > 1){

                        if($this->tableExist($foreign[1])){

                            $sqlForeign = "SELECT * FROM {$foreign[1]}";
                            $queryForeign = $this->mysqli->query($sqlForeign);
                            $combo = "";

                            while($rowForeign = $queryForeign->fetch_array(MYSQL_ASSOC) ){

                                $combo.="<option value='{$rowForeign['id']}'>{$rowForeign['nombre']}</option>";

                            }

                            echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><select name='{$row['Field']}'>{$combo}</select></p>
                              </div>";

                            $flag = false;

                        }


                    }else if(count($img) > 1){
                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><input type='file' name='{$row['Field']}' class='{$row['Type']}' /></p>
                              </div>";
                        $flag = false;
                    }


                    if($flag){
                        echo "<div class='row-abc'>
                                 <p class='descripcion'>{$row['Field']}</p>
                                 <p class='input'><input type='text' name='{$row['Field']}' class='{$row['Type']}' /></p>
                              </div>";
                    }
                }

            }
            echo '<div class="row-abc"><p class="input"><input type="submit" value="Insertar"/></p></div>';
            echo '</form>';

        }

        function createLeft($tabla){

       }


       function insertRegister(){

       }
		
	}

?>