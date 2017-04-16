<?php
$cms->printHeadTitle($cuerpoLimpio);
$c = new Hairstyle();

?>


<section class="main_content">
    <div class="container">
        <div class="row">
            <div class="span12">

                <!-- CONTACT -->
                <section class="xx_content desc">
                    <div class="contact">

                        <!-- GOOGLE MAP -->
                        <h4>Encuéntranos</h4>
                        <div class="google_map">
                            <iframe src="//www.google.com/maps/embed/v1/place?q=estudio805&key=AIzaSyCqAH27lOkp-7RKAoNjrAyp82jZnakBWlg" width="400" height="350"></iframe>
                        </div>
                        <!-- GOOGLE MAP -->


                        <!-- ADDRESS -->
                        <div class="row">
                            <div class="span4">
                                <div class="xx_location xx_di">
                                    <i class="xcon-home"></i> <span>Estudio 805, Av Progreso 9, Colonia Escandón Ciudad de México</span>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="xx_phone xx_di">
                                    <i class="xcon-phone"></i> <span> Teléfono: 55 1922 0534</span>
                                </div>
                            </div>
                            <div class="span4">
                                <div class="xx_email xx_di">
                                    <i class="xcon-mail"></i> <span>Email: info@estudio805.com <br /> Web: www.estudio805.com</a></span>
                                </div>
                            </div>
                        </div>
                        <!-- /ADDRESS -->
                        <div class="xx_margin"></div>

                        <h4>Contáctanos</h4>
                        <p>{{CONTACTANOS_TEXTO}}</p>

                        <!-- FORM -->
                        <form action="/" method="post" class="contact_form" id="contact_form">

                            <div class="returnmessage" data-success="Your message has been received, We will contact you soon."></div>

                            <div class="empty_notice">
                                <span>Por favor llena todos los campos marcados con (*)</span>
                            </div>

                            <div class="row_wrap">
                                <div class="xx_col_a">
                                    <div class="xx_row">
                                        <label>Nombre: <span>*</span></label>
                                        <input type="text" id="nombre" placeholder=""/>
                                    </div>

                                    <div class="xx_row">
                                        <label>Correo: <span>*</span></label>
                                        <input type="text" id="correo" placeholder=""/>
                                    </div>

                                    <div class="xx_row">
                                        <label>Teléfono:</label>
                                        <input type="text" id="telefono" placeholder=""/>
                                    </div>

                                </div>
                                <div class="xx_col_b">

                                    <div class="xx_row">
                                        <label>Asunto:</label>
                                        <input type="text" id="subject" placeholder=""/>
                                    </div>


                                    <div class="xx_row">
                                        <label>Mensaje: <span>*</span></label>
                                        <textarea id="message" placeholder="" cols="6" rows="6"></textarea>
                                    </div>
                                    <div class="xx_row">
                                        <input type="button" class="message_submit" id="submit" value="Contactar"/>
                                    </div>
                                </div>

                            </div>

                        </form>
                        <!-- /FORM-->


                    </div>
                </section>
                <!-- /CONTACT -->

            </div>

        </div>
    </div>
</section>



