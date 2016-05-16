<?php
echo "<div class='admin-right-column admin-only-right'>";

echo "<input type='hidden' id='extra-value' value='sucursalCalidadInner' />";

$dynamicObj = new Medios("sucursalCalidadInner");
$dynamicObj->createGridBase($tabla[0]);

echo "</div>";