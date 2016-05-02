<div class="well-lg well detail-inside establecimiento-inner left-form-establecimiento">
    <?php
    $a = new Medios('establecimientoInner');
    $title = " Visualización";
    $id = !empty($_GET['id']) ? $_GET['id'] : die('Error de datos');
    $data = $a->dbo->select('establecimiento',"id={$id}");
    $query = $a->db->query($data);
    $preselected = array();
    $data = $a->util->queryArray($query);
    $preselected['id_marca'] = $data[0]['id_marca'];
    $preselected['id_lead'] = $data[0]['id_lead'];
    $a->createGenericForm('establecimiento',$id,"update",$preselected, $title,'disabled');
    $sql = $a->dbo->selectAutoJoin('colonia', $data[0]['id_colonia_ajax']);
    $query = $a->db->query($sql);
    $data_dir = $a->util->queryArray($query);

    $sql = $a->dbo->selectAutoJoin('lead', $data[0]['id_lead']);
    $query = $a->db->query($sql);
    $admin = $a->util->queryArray($query);
    ?>
</div>
<input type='hidden' id='main-value' value='<?php echo !empty($_GET['id']) ? $a->util->limpiar($_GET['id']) : "";?>' />
<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#info-table"><i class='fa fa-plus fa-fw'></i> Info General</h3></div>

    <div id="info-table" class="collapse">
        <!-- Table -->
        <table class="table">
            <tr>
                <td><strong>Marca</strong></td>
                <td><?php echo $admin[0]['marca_nombre']; ?></td>
            </tr>
            <tr>
                <td><strong>Giro</strong></td>
                <td><?php echo $admin[0]['giro_nombre']; ?></td>
            </tr>

            <tr>
                <td><strong>Afiliador</strong></td>
                <td><?php echo $admin[0]['admin_nombre']; ?></td>
            </tr>
        </table>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#direccion-table"><i class='fa fa-plus fa-fw'></i> Dirección</h3></div>


    <div id="direccion-table" class="collapse">
        <?php if(!empty($data_dir[0])){ ?>
            <table class="table">
                <tr>
                    <td><strong>Estado:</strong></td>
                    <td><?php echo $data_dir[0]['estado_nombre']; ?></td>
                </tr>
                <tr>
                    <td><strong>Delegación/Municipio:</strong></td>
                    <td><?php echo $data_dir[0]['municipio_nombre']; ?></td>
                </tr>
                <tr>
                    <td><strong>Código postal: </strong></td>
                    <td><?php echo $data_dir[0]['cp_nombre']; ?></td>
                </tr>
                <tr>
                    <td><strong>Colonia:</strong></td>
                    <td><?php echo $data_dir[0]['nombre']; ?></td>
                </tr>
                <tr>
                    <td><strong>Calle:</strong></td>
                    <td><?php echo $data[0]['calle']; ?></td>
                </tr>
                <tr>
                    <td><strong>Número Exterior - Interior:</strong></td>
                    <td><?php echo $data[0]['no_exterior'] . " - " . $data[0]['no_interior']; ?></td>
                </tr>
                <tr>
                    <td><strong>Latitud, Longitud: </strong></td>
                    <td><?php echo $data[0]['latitud'] . "," . $data[0]['longitud']; ?></td>
                </tr>
            </table>
        <?php }?>

    </div>
    </div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#clasificacion-add"><i class='fa fa-plus fa-fw'></i> Modificar Clasificaciones</h3></div>

    <div id="clasificacion-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoClasificacionInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#servicio-add"><i class='fa fa-plus fa-fw'></i> Modificar Servicios</h3></div>

    <div id="servicio-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoServicioInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#comida-add"><i class='fa fa-plus fa-fw'></i> Modificar Comida</h3></div>

    <div id="comida-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoComidaInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#musica-add"><i class='fa fa-plus fa-fw'></i> Modificar Música</h3></div>

    <div id="musica-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoMusicaInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#pago-add"><i class='fa fa-plus fa-fw'></i> Modificar Forma de pago</h3></div>

    <div id="pago-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoPagoInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>

<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#vestimenta-add"><i class='fa fa-plus fa-fw'></i> Modificar Vestimenta</h3></div>

    <div id="vestimenta-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoVestimentaInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>


<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#ideal-add"><i class='fa fa-plus fa-fw'></i> Modificar Ideal para</h3></div>

    <div id="ideal-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoIdealInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>


<div class="panel panel-default detail-inside establecimiento-info">
    <!-- Default panel contents -->
    <div class="panel-heading"><h3 class="panel-title"  data-toggle="collapse" data-target="#oportunidad-add"><i class='fa fa-plus fa-fw'></i> Modificar Oportunidades</h3></div>

    <div id="oportunidad-add" class="collapse edit-form">
        <?php
        $a = new Medios('establecimientoOportunidadInner');
        $a->createGenericForm('establecimiento',$id,"update",$preselected, "");
        ?>
    </div>
</div>


<div class="admin-generic admin-bottom">


    <div class="well well-lg">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" role="tablist">
            <li role="presentation" class="active"><a href="#sucursales" aria-controls="sucursales" role="tab" data-toggle="tab">Sucursales</a></li>
            <li role="presentation"><a href="#clasificaciones" aria-controls="clasificaciones" role="tab" data-toggle="tab">Clasificaciones</a></li>
            <li role="presentation"><a href="#servicios" aria-controls="servicios" role="tab" data-toggle="tab">Servicios</a></li>
            <li role="presentation"><a href="#comida" aria-controls="comida" role="tab" data-toggle="tab">Comida</a></li>
            <li role="presentation"><a href="#musica" aria-controls="musica" role="tab" data-toggle="tab">Música</a></li>
            <li role="presentation"><a href="#formapago" aria-controls="formapago" role="tab" data-toggle="tab">Forma pago</a></li>
            <li role="presentation"><a href="#vestimenta" aria-controls="vestimenta" role="tab" data-toggle="tab">Vestimenta</a></li>
            <li role="presentation"><a href="#idealpara" aria-controls="idealpara" role="tab" data-toggle="tab">Ideal para</a></li>
            <li role="presentation"><a href="#oportunidades" aria-controls="oportunidades" role="tab" data-toggle="tab">Oportunidades</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content tabs-establecimiento table-bordered">
            <div role="tabpanel" class="tab-pane active" id="sucursales">
                <?php
                $sucursal = new Medios('sucursalInner');
                $sucursal->createGridBase('sucursal',false,'sucursalInner');
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="clasificaciones">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_clasificacion'],'establecimiento_clasificacion');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="servicios">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_servicio'],'establecimiento_servicio');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="comida">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_comida'],'establecimiento_comida');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="musica">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_musica'],'establecimiento_musica');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="formapago">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_pago'],'establecimiento_pago');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="vestimenta">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_vestimenta'],'establecimiento_vestimenta');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="idealpara">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_ideal'],'establecimiento_ideal');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="oportunidades">
                <?php
                $sql = $a->dbo->unserializeForeign($data[0]['id_serialized_establecimiento_oportunidad'],'establecimiento_oportunidad');
                if(!empty($sql)){
                    $query = $a->db->query($sql);
                    $data_ = $a->util->queryArray($query);
                    $a->util->foreingList($data_);
                }
                ?>
            </div>
        </div>

    </div>



</div>
