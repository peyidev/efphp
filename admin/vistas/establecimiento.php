<?php
echo "<div class='admin-right-column admin-only-right'>";

echo "<input type='hidden' id='extra-value' value='establecimientoInner' />";

$dynamicObj = new Medios("establecimientoInner");
$dynamicObj->createGridBase($tabla[0]);

echo "</div>";