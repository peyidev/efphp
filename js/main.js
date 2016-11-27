jQuery(function($) {'use strict';

  //Responsive Nav
  $('li.dropdown').find('.fa-angle-down').each(function(){
    $(this).on('click', function(){
      if( $(window).width() < 768 ) {
        $(this).parent().next().slideToggle();
      }
      return false;
    });
  });

  //Fit Vids
  if( $('#video-container').length ) {
    $("#video-container").fitVids();
  }

  //Initiat WOW JS
  new WOW().init();

  // portfolio filter
  $(window).load(function(){

    $('.main-slider').addClass('animate-in');
    $('.preloader').remove();
    //End Preloader

    if( $('.masonery_area').length ) {
      $('.masonery_area').masonry();//Masonry
    }

    var $portfolio_selectors = $('.portfolio-filter >li>a');

    if($portfolio_selectors.length) {

      var $portfolio = $('.portfolio-items');
      $portfolio.isotope({
        itemSelector : '.portfolio-item',
        layoutMode : 'fitRows'
      });

      $portfolio_selectors.on('click', function(){
        $portfolio_selectors.removeClass('active');
        $(this).addClass('active');
        var selector = $(this).attr('data-filter');
        $portfolio.isotope({ filter: selector });
        return false;
      });
    }

  });


  $('.timer').each(count);
  function count(options) {
    var $this = $(this);
    options = $.extend({}, options || {}, $this.data('countToOptions') || {});
    $this.countTo(options);
  }

  // Search
  $('.fa-search').on('click', function() {
    $('.field-toggle').fadeToggle(200);
  });

  // Contact form
  var form = $('#main-contact-form');
  form.submit(function(event){
    event.preventDefault();
    var form_status = $('<div class="form_status"></div>');
    $.ajax({
      url: $(this).attr('action'),
      beforeSend: function(){
        form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
      }
    }).done(function(data){
      form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
    });
  });

  // Progress Bar
  $.each($('div.progress-bar'),function(){
    $(this).css('width', $(this).attr('data-transition')+'%');
  });

  // SLIDER
  $( function() {
    $( "#slider" ).slider();
  } );



var addresses = [
   '101 S Busey Ave Champaign, IL'
  ,'102 S Lincoln Avenue  Champaign, IL'
  ,'605 E Clark Street  Champaign, IL'
  ,'606 E White  Champaign, IL'
  ,'205 S Sixth Street  Champaign, IL'
  ,'303 S Fifth Street  Champaign IL'
  ,'203 S Fourth Street C  Champaign, IL'
  ,'311 E Clark Street  Champaign, IL'
  ,'314 E Clark Street  Champaign, IL'
  ,'808 S Oak Street  Champaign, IL'
  ,'803 S Locust Street  Champaign, IL'
  ,'805 S Locust  Champaign, IL'
  ,'61 E John Street  Champaign, IL'
  ,'803 S First Street  Champaigne, IL'
  ,'101 E Daniel  Champaign, IL'
  ,'101 E Armory Street  Champaign, IL'
  ,'1711-B Harrington Drive  Champaign, IL'
  ,'1711-A Harrington Drive  Champaign, IL'
  ];


  if( $('#gmap').length ) {
    var map;

    //CODIGO QUE VA EN CADA PROPIEDAD CON LA DIRECICON
    GMaps.geocode({
      address: '303 S Fifth Street Champaign, IL 61820',
      callback: function(results, status) {
        if (status == 'OK') {
          var latlng = results[0].geometry.location;
          map.setCenter(latlng.lat(), latlng.lng());
          map.addMarker({
            lat: latlng.lat(),
            lng: latlng.lng(),
            animation: google.maps.Animation.DROP,
            infoWindow: {
              content: '<p>HTML Content</p>'
            }
          });
        }
      }
    });

    function setMarkers(address){
      GMaps.geocode({
        address: address,
        callback: function(results, status) {
          if (status == 'OK') {
            var latlng = results[0].geometry.location;
            map.addMarker({
              lat:  latlng.lat(),
              lng:  latlng.lng(),
              animation: google.maps.Animation.DROP,
              infoWindow: {
                content: '<p>'+address+'</p>'
              }
            });
          }
        }
      });
    }

    for(var obj in addresses){
      setMarkers(addresses[obj])
    };


    map = new GMaps({
      div: '#gmap',
      lat: '41.869795',
      lng: '-87.62637799999999',
      scrollwheel:false,
      zoom: 14,
      zoomControl : true,
      panControl : false,
      streetViewControl : true,
      mapTypeControl: false,
      overviewMapControl: false,
      clickable: true,

    });



  }

});