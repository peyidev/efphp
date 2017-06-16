<div class="no-display" id="sothtml">{{special_top_left}}{{special_top_right}}</div>
<div class="no-display" id="sobhtml">{{special_bottom_left}}{{special_bottom_right}}</div>
<!--/#specialOffter flags -->

<section class="special-offer-section sothtml">
  <div class="container">
    <div class="special-offer-top bg-404 special-offer-content">
      <div class="special-left">{{special_top_left}}</div>
      <div class="special-right tmp-marq">{{special_top_right}} <span class="gradient"></span> </div>
    </div>
  </div>
</section>
<!--/#specia offer top-->

<!--
<section id="home-slider-video">

  <div class="home-video-container">
    <iframe id="home-video-id" width="1280" height="720" src="{{home_video}}" frameborder="0"  allowfullscreen></iframe>
  </div>

  <div class="rwd-gal">
    <ul id="home-gallery"></ul>
  </div>


</section>
-->

<!--/#Video -->

<section class="special-offer-section sobhtml">
  <div class="container">
    <div class="special-offer-bottom bg-404 special-offer-content">
      <div class="special-left">{{special_bottom_left}}</div>
      <div class="special-right">{{special_bottom_right}}</div>
    </div>
  </div>
</section>
<!--/#specia offer bottom-->

<section id="map-home">
    <div class="container">
        <div class="row">
            <div id="map-container">
                <div id="gmap"></div>
            </div>
        </div>
    </div>
</section>
<!--/#map-container-->

{{home_slider}}
<!--/#home-slider-->

<section id="home-special">
  <div class="container">
    <div class="row">
      <div class="main-slider">
        <div class="slide-text">
          <i class="fa fa-location-arrow slider-sun"></i>

          <span class="sc_title_box" id="main-ft-name"></span>
          <p id="main-ft-desc"></p>
          <div class="amenities-list" id="main-ft-ameni"></div>

        </div>

        <div class="slide-img-special" id="main-ft-img"></div>

      </div>
    </div>
  </div>
  <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
</section>
<!--/#Special-->

<!--Testimonials-->
<section id="tertimonials" class="b-b-ddd p-b-lg">
    <div class="container">
        <div class="row">
            <h2>Testimonial</h2>
            <div class="col-lg-6">
                <p>“Overall excellent. My apartment has great amenities (central a/c, washer/dryer, parking below building, dishwasher), a nice layout, and decent furnishings. Maintenance has always responded quickly. The building is also really quiet. Best apartment experience I’ve had so far.”
                                    – Daniel (August 2014)</p>
            </div>
            <div class="col-lg-6">
                <p>“My experience with MHM was great! The apartment was super clean and had great furniture. They are the best management company!”
                    – Katie (Tenant 2012)</p>
            </div>

        </div>
    </div>
</section>
<!--END Testimonials-->

<section id="services">
  <div class="container">
    <div class="row">
      <h2>FEATURED</h2>
      <div id="feautured-list" class="no-display"></div>
    </div>
  </div>
</section>
<!--/#services-->

<section id="full-properties" class="p-d-xl bg-white">
  <ul class="portfolio-filter text-center" id="prop-filter-list">
    <li><a class="btn btn-default active" href="#" data-filter=".APARTMENT">Apartments</a></li>
    <li><a class="btn btn-default " href="#" data-filter=".HOUSE">Houses</a></li>
    <li><a class="btn btn-default " href="#" data-filter=".CONDOS">Condos</a></li>
  </ul>
  <div class="portfolio-items" id="inject-full-properties"></div>
</section>
<!--/#services-->








<div id="showing-form" class="showing-float">Schedule Showing <i class="fa fa-angle-up"></i></div>



<!--/#MODAL-->
<div class="property-modal no-display" id="property-modal" ></div>
<div class="schedule-form no-display">
  <div class="close fa fa-plus"></div>

  <div class="modal-form">
    <div class="contact-form bottom">
      <h2 class="h2-white">SCHEDULE SHOWING</h2>
      <form id="main-contact-form" name="contact-form" method="post" action="lib/Execute.php?e=Frontend/saveContact/contact&back=1">
        <div class="form-group">
          <input type="text" name="name" class="form-control" required="required" placeholder="Name">
        </div>
        <div class="form-group">
          <input type="text" name="cel" class="form-control" required="required" placeholder="Telephone">
        </div>
        <div class="form-group">
          <input type="email" name="email" class="form-control" required="required" placeholder="Email">
        </div>
        <div class="form-group">
          <label for="">Type of BR.</label>
          <select name="br_type">
            <option value="Not Enters" selected="selected">Select One…</option>
            <option value="Not Sure - All Size">Not Sure / All Size</option>
            <option value="1 Bed">1 Bedroom</option>
            <option value="2 Bed">2 Bedroom</option>
            <option value="3 Bed">3 Bedroom</option>
            <option value="4 Bed">4 Bedroom</option>
            <option value="5+ Bed">5+ Bedroom</option>
          </select>
        </div>
        <div class="form-group">
            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Your text here">Request/Question:
            Ideal Showing Day/time: </textarea>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" class="btn btn-submit" value="Submit">
        </div>
      </form>
    </div>
  </div>

</div>
<!--/#MODAL-->





