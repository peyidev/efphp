<?php
    $cms->printHeadTitle($cuerpoLimpio);
    $c = new Hairstyle();

?>
<section class="main_content">
    <div class="container">
        <div class="row">

            <!-- SIDEBAR -->
            <?php echo $c->categoryPage();?>
            <!-- /SIDEBAR -->

        </div>
    </div>
</section>
