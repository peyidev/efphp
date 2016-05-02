<?php
echo "<div class='admin-right-column admin-only-right'>";

echo "<input type='hidden' id='extra-value' value='sucursalBienvenidaInner' />";

$dynamicObj = new Medios("sucursalBienvenidaInner");
$dynamicObj->createGridBase($tabla[0]);

echo "</div>";