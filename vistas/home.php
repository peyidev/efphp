<?php
$c = new Hairstyle();
echo $c->getSliderHome();
?>

<!-- MAIN CONTENT -->
<section class="main_content home">
    <div class="container">
        <div class="row">
            <div class="span12">

                <!-- FROM SERVICE -->
                <?php echo $c->getServiciosHome()?>
                <!-- /FROM SERVICE -->


                <!-- TESTIMONIALS -->
                <?php echo $c->getTestimoniosHome()?>
                <!-- /TESTIMONIALS -->

            </div>
        </div>
    </div>
</section>
<!-- /MAIN CONTENT -->
