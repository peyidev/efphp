<div class="well well-lg llamada-detalle-well">
    <div class="info-llamada">

        <?php

        $p = explode(',',$params);
        $table = $p[0];
        $foreign = !empty($p[1]) ? $p[1] : "";
        $id = !empty($p[2]) ? $p[2] : "";

        $m = new Medios("llamadaSeguimientoDetailInner");
        $sql = $m->dbo->select(
            "llamada
                        JOIN telemarketing_queja
                        ON llamada.id = telemarketing_queja.id_llamada",
            "llamada.id={$id}");
        $query = $m->db->query($sql);
        $data = $m->util->queryArray($query);
        ?>

        <table class="table">
            <tr>
                <td>Folio</td>
                <td><?php echo $data[0]['folio']?></td>
            </tr>

            <tr>
                <td>Nombre</td>
                <td><?php echo $data[0]['nombre'] . " " . $data[0]['apellido_paterno'] . " " . $data[0]['apellido_materno']?></td>
            </tr>

            <tr>
                <td>Teléfono</td>
                <td><?php echo $data[0]['telefono_1']?></td>
            </tr>

            <tr>
                <td>Email</td>
                <td><?php echo $data[0]['email']?></td>
            </tr>

            <tr>
                <td>Marca</td>
                <td><?php echo $data[0]['marca']?></td>
            </tr>

            <tr>
                <td>Fecha visita</td>
                <td><?php echo $data[0]['visita']?></td>
            </tr>

            <tr>
                <td>Comentario</td>
                <td><?php echo $data[0]['comentarios_queja']?></td>
            </tr>


        </table>

    </div>

    <div class="insert-llamada">

        <?php

        $this->createAjaxInsert($params,"insert");
        ?>

    </div>


</div>


<div class="grid-llamada">
    <?php
        $m->createGrid("llamada_seguimiento",false,"id_llamada='{$id}'");
    ?>
</div>

<script type="text/javascript">
    $('document').ready(function(){
        $('.insert-llamada').find("[name='monto']").parent().parent().hide();
        $('.insert-llamada').find("[name='beneficio']").parent().parent().hide();
        $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().hide();


        $('[name="id_acuerdo_llamada"]').change(function () {

            var val = $(this).find('option[value="' + $(this).val() + '"]').text();

            switch (val){

                case "Reembolso":

                    $('.insert-llamada').find("[name='monto']").parent().parent().show();
                    $('.insert-llamada').find("[name='beneficio']").parent().parent().hide();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().parent().show();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().show();

                    break;
                case "Otro beneficio":
                    $('.insert-llamada').find("[name='monto']").parent().parent().hide();
                    $('.insert-llamada').find("[name='beneficio']").parent().parent().show();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().parent().show();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().show();

                    break;
                default :

                    $('.insert-llamada').find("[name='monto']").parent().parent().hide();
                    $('.insert-llamada').find("[name='beneficio']").parent().parent().hide();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().hide();
                    $('.insert-llamada').find("[name='id_beneficiario']").parent().parent().parent().hide();

                    break;

            }

            if(val == "Llamada válida"){

                $('.disabled').prop('disabled', false);
                $('[name="id_proyecto"]').prop('disabled', false);

                $('.disabled').removeClass('disabled');
                $('button[type="submit"]').hide();


            }else{

                $('button[type="submit"]').show();
                $('[name="id_proyecto"]').prop('disabled', true);

            }
        });

    });
</script>