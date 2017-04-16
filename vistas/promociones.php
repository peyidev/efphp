<?php
$cms->printHeadTitle($cuerpoLimpio);
$c = new Hairstyle();

?>
<!-- MAIN CONTENT -->
<section class="main_content home">
    <div class="container">
        <div class="row">
            <div class="span12">
                <?php $c->promocionesPage();?>
            </div>
        </div>
    </div>
</section>
<!-- /MAIN CONTENT -->
