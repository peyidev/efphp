function tabby(id){
			var t = id.substr(id.length - 1);
			var tActiveHeight = $('.tabs__content--' + t).height();
			$('.tabs__content').height(tActiveHeight);
			console.log(id);
		}

		$(document).ready(function(){

			/* 
			// Collapsible
			$('.main-nav--collapsible > .main-nav__link').click(function(){
				$(this).parent().toggleClass('main-nav--open');
				if( $(this).parent().siblings().hasClass('main-nav--open') ){
					$(this).parent().siblings().removeClass('main-nav--open');
				}
			return false;
			})
			*/
			$(window).load(function(){
				var id = $('.tabs input:checked').attr('id');
				tabby(id);	
			})

			
			$( window ).resize(function(){
				var id = $('.tabs input:checked').attr('id');
				tabby(id);
			})
			$('.tabs input').change(function(){
				var id = $('.tabs input:checked').attr('id');
				tabby(id);
			})


			$('.c-btn--check').click(function(){
				$(this).parent().parent().toggleClass('user--added');
			})

			$(".spinner").spinner({
				icons: { down: "ui-icon-carat-1-s", up: "ui-icon-carat-1-n" },
				min:1,
				max:3
			});

			$('.slider').slider();

			$('.slider.range').slider({
				range: true,
			    max: 750,
			    values: [ 75, 300 ],
				slide: function( event, ui ) {
			        $( "#amount-min" ).html("$" + ui.values[0]);
			        $( "#amount-max" ).html("$" + ui.values[1]);
			      }
			});
			$( "#amount-min" ).html( "$" + $( ".slider.range" ).slider( "values", 0));
			$( "#amount-max" ).html( "$" + $( ".slider.range" ).slider( "values", 1));

			$('.slider.range-min').slider({
				range: "min",
				min:50,
					slide: function( event, ui ) {
			        $('.slider.range-min > a.ui-slider-handle').html("<div class='range-tooltip'>$ " + $(".slider.range-min").slider("value") + "</div>")
			      },
			    stop: function( event, ui ) {
			    	$('.range-tooltip').delay(1000).fadeOut();
			    },
			    value:60
			});
			$( "#amount-block" ).html("Min: $" + $(".slider.range-min").slider( "option", "min"));
			$('.slider.range-min > a.ui-slider-handle').hover(function(){
				$('.slider.range-min > a.ui-slider-handle').html("<div class='range-tooltip'>$ " + $(".slider.range-min").slider("value") + "</div>")
				$('.range-tooltip').delay(1000).fadeOut();
			})

			$('.mobile-nav').click(function(){
				$('.main-nav').toggleClass('open');
			})

			$('.back-top').click(function(){
				$('html, body').animate({scrollTop:0}, 500);
        return false;
			})


}) // Ready