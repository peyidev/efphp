<div class='row-abc'>
    <p class='descripcion'>Proyecto</p>
    <p class='input'>
        <select class='selectpicker form-control' id='proyecto-select'>
            <?php

            $m = new Medios("llamadaSeguimientoInner");
            $sql = $m->dbo->select("proyecto");
            $query = $m->db->query($sql);
            $row = $m->util->queryArray($query);
            echo "<option value='0'>Seleccionar proyecto</option>";
            echo "<option value='-1'>Todos</option>";
                foreach($row as $val){
                    echo "<option value='{$val['id']}'>{$val['nombre']}</option>";
                }
            ?>
        </select>
    </p>
</div>

<div>

    <input type='hidden' id='main-value' value='<?php echo !empty($_GET['proyecto']) ? $m->util->limpiar($_GET['proyecto']) : "";?>' />
    <?php

        if(!empty($_GET['proyecto'])){

            echo "<input type='hidden' id='extra-value' value='llamadaSeguimientoInner' />";
            $dynamicObj = new Medios("llamadaSeguimientoInner");
            $dynamicObj->createGridBase('telemarketing_queja');

        }

    ?>
</div>