<?php
$cms->printHeadTitle($cuerpoLimpio);
$c = new Hairstyle();

?>

<section class="main_content home">
    <div class="container">
        <div class="row">
            <div class="span12">

              <?php
                echo $c->getArticulosTendencias();
              ?>
            </div>
        </div>
    </div>
</section>
