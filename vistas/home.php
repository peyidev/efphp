<div class="no-display" id="sothtml">{{special_top_left}}{{special_top_right}}</div>
<div class="no-display" id="sobhtml">{{special_bottom_left}}{{special_bottom_right}}</div>
<!--/#specialOffter flags -->

<section class="special-offer-section sothtml">
  <div class="container">
    <div class="special-offer-top bg-404 special-offer-content">
      <div class="special-left">{{special_top_left}}</div>
      <div class="special-right">{{special_top_right}}</div>
    </div>
  </div>
</section>
<!--/#specia offer top-->

<section id="home-slider-video">
  <div class="home-video-container">

    <iframe id="home-video-id" width="1280" height="720" src="{{home_video}}?rel=0&autoplay=1&controls=0&showinfo=0&loop=1&iv_load_policy=3&enablejsapi=1" frameborder="0"  allowfullscreen></iframe>
  </div>

  <div class="rwd-gal">
    <ul id="home-gallery"></ul>
  </div>

<!--  <div class="special-gal">-->
<!--    <ul id="lightSlider">-->
<!--      <li><a href="#"><div><label>SPECIAL OFFER #1</label></div></a></li>-->
<!--      <li><a href="#"><div><label>SPECIAL OFFER #2</label></div></a></li>-->
<!--      <li><a href="#"><div><label>SPECIAL OFFER #3</label></div></a></li>-->
<!--      <li><a href="#"><div><label>SPECIAL OFFER #4</label></div></a></li>-->
<!--    </ul>-->
<!--  </div>-->

</section>
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

<section id="services">
  <div class="container">
    <div class="row">
      <h2>FEAUTURED</h2>
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





