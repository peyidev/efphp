<?php
    echo "<div class='admin-right-column admin-only-right'>";

        echo "<input type='hidden' id='extra-value' value='leadInner' />";

        $dynamicObj = new Medios("leadInner");
        $dynamicObj->createGridBase($tabla[0]);

    echo "</div>";