<!--/#PropertyDetails-->
<section id="home-special" class="p-t-lg p-d-xl b-b-ddd p-detail anim i-page">
  <div class="container">
    <div class="row">
      <div class="main-slider">

        <div class="title-out">
          <i class="fa fa-location-arrow slider-sun"></i>
          <span class="sc_title_box" id="p-detail-name"></span>
        </div>
        <div class="slide-text p-detail-size">
          <p id="p-detail-desc"></p>
        </div>
        <div id="p-detail-img" class="p-detail-size"></div>
        <div class="slide-img-special p-detail-size">
          <div class="right-grid slider-hill">
            <a href="#detail-video"><div class="tool tool-1"><i class="fa fa-youtube-play"></i></div></a>
            <a href="#detail-plans"><div class="tool tool-2 no-border"><div class="fa-plans"><img src="images/fplans-b.jpg" alt="floorplans" title="floorplans"/></div></div></a>
            <a href="#detail-slider"><div class="tool tool-3"><i class="fa fa-camera"></i></div></a>
            <a href="#detail-amenities"><div class="tool tool-4 no-border"><i class="fa fa-plus"></i></div></a>
            <a href="#map-home"><div class="tool tool-5"><i class="fa fa-map-marker"></i></div></a>
            <a href="#" id="showing-form"><div class="tool tool-6 no-border"><i class="fa fa-clock-o"></i></div></a>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="preloader"><i class="fa fa-sun-o fa-spin"></i></div>
</section>
<!--/#Special-->

<!--/#PropertyAmenities-->
<section id="detail-amenities" class="bg-white p-t-lg p-d-xl animate-in b-b-ddd anim">
  <div class="container">
    <span class="d-ameni-title">
      Features & Amenities
    </span>
    <div class="amenities-list d-ameni-list" id="p-detail-amenities"></div>
    </div>
  </div>
</section>
<!--/#Features & Amenities-->

<!--/#PropertyNearby-->
  <!--/#PropertyMap-->
<section id="detail-transportation" class="bg-white p-t-lg p-d-xl animate-in b-b-ddd anim">
  <div class="container" id="p-detail-nearby-cs">

    <div class="col-lg-6 col-xs-12">
      <span class="d-ameni-title">
        Nearby Public Places and Transportation
      </span>
      <div class="amenities-list d-ameni-list" id="p-detail-nearby"></div>
    </div>

    <div class="col-lg-6 col-xs-12">
      <div id="map-container">
        <div id="gmap"></div>
      </div>
    </div>

  </div>
</section>
  <!--/#Map-->
<!--/#Nearby Public places and transportion-->

<!--/#PropertyVideo-->
<section id="detail-video" class=" bg-white p-t-lg p-d-xl animate-in b-b-ddd">
  <div class="container">
    <span class="d-ameni-title">
      Video Tour Details
    </span>

    <div class="home-video-container" id="p-detail-video"></div>

  </div>
</section>
<!--/#Nearby Public places and transportion-->

<!--/#PropertyGallery-->
<section id="detail-slider" class="bg-white p-t-lg p-d-xl animate-in b-b-ddd anim">
  <div class="container">
    <span class="d-ameni-title">Gallery</span>
    <ul id="lightSlider"></ul>
  </div>
</section>
<!--/#Detail Slider-->

<!--/#PropertyFloorplansFallery-->
<section id="detail-plans" class="bg-white p-t-lg p-d-xl animate-in b-b-ddd anim">
  <div class="container detail-plans-coming-soon">
    <span class="d-ameni-title">Floorplans</span>

    <ul id="plan-gallery"></ul>

  </div>
</section>
<!--/#PropertyFloorplansFallery-->


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
