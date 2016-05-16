<?php
$p = explode(',',$params);
$table = $p[0];
$foreign = !empty($p[1]) ? $p[1] : "";
$id = !empty($p[2]) ? $p[2] : "";

$m = new Medios("calidadDetalleInner");
$id = $m->util->limpiar($id);
$sql = "SELECT *
            FROM sucursal AS s JOIN marca AS m ON m.id = s.id_marca
              JOIN lead AS l ON m.id = l.id_marca
              JOIN contrato_lead AS cl ON l.id = cl.id_lead
            WHERE s.id = '{$id}'
            ORDER BY inicio_contrato DESC
            LIMIT 1;";

echo "<h1>QUÉ INFO SE VA A MOSTRAR EN REALIDAD?</h1>";
echo $sql  . "<br /><br /><br />";


$query = $m->db->query($sql);
$data = $m->util->queryArray($query);
print_r($data);
