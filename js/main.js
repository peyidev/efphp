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
  //
  //// Contact form
  //var form = $('#main-contact-form');
  //form.submit(function(event){
  //  event.preventDefault();
  //  var form_status = $('<div class="form_status"></div>');
  //  $.ajax({
  //    url: $(this).attr('action'),
  //    beforeSend: function(){
  //      form.prepend( form_status.html('<p><i class="fa fa-spinner fa-spin"></i> Email is sending...</p>').fadeIn() );
  //    }
  //  }).done(function(data){
  //      console.log(data);
  //    form_status.html('<p class="text-success">Thank you for contact us. As early as possible  we will contact you</p>').delay(3000).fadeOut();
  //  });
  //});

  // Progress Bar
  $.each($('div.progress-bar'),function(){
    $(this).css('width', $(this).attr('data-transition')+'%');
  });

  // SLIDER
  $( function() {
    $( "#slider" ).slider();
  } );


});

var addressName = false;

var player;

function onYouTubeIframeAPIReady() {
  player = new YT.Player('home-video-id', {
    events: {
      'onReady': onPlayerReady
    }
  });
}

function onPlayerReady(event) {
  player.mute();
  player.playVideo();
}