<?php
    if($cms->sectionExistInMenu($cuerpoLimpio)){

        echo '<section class="main_title">
                    <div class="container">
                        <div class="row">
                            <div class="span12">
                                <h1>'. $cms->sectionExistInMenu($cuerpoLimpio) .'</h1>
                            </div>
                        </div>
                    </div>
                </section>
                ';
    }else{?>
        <section class="main_title">
            <div class="container">
                <div class="row">
                    <div class="span12">
                        <h1>Error 404</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="main_content home">
            <div class="container">
                <div class="row">
                    <div class="span12">


                        {{HOME_SERVICIOS}}
                    </div>
                </div>
            </div>
        </section>
<?php
    }
?>