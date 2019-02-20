(function($) {
	
	"use strict";
	
	//Hide Loading Box (Preloader)
	// function handlePreloader() {
	// 	if($('.preloader').length){
	// 		$('.preloader').delay(0).fadeOut(0);
	// 	}
	// }
	
	//Update Header Style and Scroll to Top
	function headerStyle() {
		if($('.main-header').length){
			var windowpos = $(window).scrollTop();
			var siteHeader = $('.main-header');
			var scrollLink = $('.scroll-to-top');
			var logoContainer = $(".small-logo-cnt");
			if (windowpos >= 250) {
				siteHeader.addClass('fixed-header');
				scrollLink.fadeIn(300);
				logoContainer.show();
			} else {
				siteHeader.removeClass('fixed-header');
				scrollLink.fadeOut(300);
				logoContainer.hide();
			}
		}
	}
	
	headerStyle();
	
	//Submenu Dropdown Toggle
	if($('.main-header li.dropdown ul').length){
		$('.main-header li.dropdown').append('<div class="dropdown-btn"><span class="fa fa-angle-down"></span></div>');
		
		//Dropdown Button
		$('.main-header li.dropdown .dropdown-btn').on('click', function() {
			$(this).prev('ul').slideToggle(500);
		});
		
		//Disable dropdown parent link
		$('.navigation li.dropdown > a').on('click', function(e) {
			e.preventDefault();
		});
	}
	

	//Gallery Filters
	if($('.filter-list').length){
		$('.filter-list').mixItUp({});
	}
	
	//Sponsors Carousel
	if ($('.sponsors-carousel').length) {
		$('.sponsors-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 700,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:3
				},
				480:{
					items:3
				},
				600:{
					items:3
				},
				800:{
					items:4
				},
				1024:{
					items:6
				},
				1200:{
					items:8
				}
			}
		});    		
	}
	
	//Single Item Slider
	if ($('.single-item-carousel').length) {
		$('.single-item-carousel').owlCarousel({
			loop:true,
			margin:30,
			nav:true,
			smartSpeed: 700,
			autoplay: 4000,
			navText: [ '<span class="fa fa-angle-left"></span>', '<span class="fa fa-angle-right"></span>' ],
			responsive:{
				0:{
					items:1
				},
				480:{
					items:1
				},
				600:{
					items:1
				},
				800:{
					items:1
				},
				1024:{
					items:1
				}
			}
		});    		
	}
	
	//Three Item Carousel
	
	
	//LightBox / Fancybox
	if($('.lightbox-image').length) {
		$('.lightbox-image').fancybox({
			openEffect  : 'fade',
			closeEffect : 'fade',
			helpers : {
				media : {}
			}
		});
	}
	
	// Scroll to a Specific Div
	if($('.scroll-to-target').length){
		$(".scroll-to-target").on('click', function() {
			var target = $(this).attr('data-target');
		   // animate
		   $('html, body').animate({
			   scrollTop: $(target).offset().top
			 }, 1000);
	
		});
	}
	
	// Elements Animation
	if($('.wow').length){
		var wow = new WOW(
		  {
			boxClass:     'wow',      // animated element css class (default is wow)
			animateClass: 'animated', // animation css class (default is animated)
			offset:       0,          // distance to the element when triggering the animation (default is 0)
			mobile:       false,       // trigger animations on mobile devices (default is true)
			live:         true       // act on asynchronously loaded content (default is true)
		  }
		);
		wow.init();
	}


/* ==========================================================================
   When document is Scrollig, do
   ========================================================================== */
	
	$(window).on('scroll', function() {
		headerStyle();
	});
	
/* ==========================================================================
   When document is loaded, do
   ========================================================================== */
	
	

})(window.jQuery);

$(document).ready(function() {

  $(".toggle-accordion").on("click", function() {
    var accordionId = $(this).attr("accordion-id"),
      numPanelOpen = $(accordionId + ' .collapse.in').length;
    
    $(this).toggleClass("active");

    if (numPanelOpen == 0) {
      openAllPanels(accordionId);
    } else {
      closeAllPanels(accordionId);
    }
  })

  openAllPanels = function(aId) {
    console.log("setAllPanelOpen");
    $(aId + ' .panel-collapse:not(".in")').collapse('show');
  }
  closeAllPanels = function(aId) {
    console.log("setAllPanelclose");
    $(aId + ' .panel-collapse.in').collapse('hide');
  }
     
});

jQuery(document).ready(function() {
    $(".video").click(function() {
        $.fancybox({
            'padding'       : 0,
            'autoScale'     : false,
            'transitionIn'  : 'none',
            'transitionOut' : 'none',
            'title'         : this.title,
            'width'         : 640,
            'height'        : 385,
            'href'          : this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
            'type'          : 'swf',
            'swf'           : {
            'wmode'             : 'transparent',
            'allowfullscreen'   : 'true'
            }
        });

            return false;
    });
});

function showSubMenu(id){
    obj = $('.sub-menu-'+id)
    if(obj.hasClass('hide')){
         $('.list-menu').addClass('hide');
        obj.removeClass('hide');
    }else{
        obj.addClass('hide');
    }
    
}


jQuery(document).ready(function() {
	let myDate = $('.date-format'); 
	let lang = $('html').attr('lang');
	
	for(j = 0; j < myDate.length	 ; j++){
		let dateStr = myDate[j].innerHTML; 
		let str = dateStr.split("-").reverse().join("-");

		
		if(lang == 'kh'){
		    str = changeDateFormat(str);
		}
		myDate[j].innerHTML = str;
	}

	if(lang == 'kh'){

		let year = $('#footer-year'); 
		year.html(changeDateFormat(year.attr('year')))
	}
	

});


function changeDateFormat(str = ""){
	let format = '';

	for( i=0; i<str.length; i++ ){
	  
	  if(str[i] == '0'){
	    format += '០'; 
	  }else if(str[i] == '1'){
	    format += '១'; 
	  }else if(str[i] == '2'){
	   format += '២'; 
	  }else if(str[i] == '3'){
	    format += '៣'; 
	  }else if(str[i] == '4'){
	   format += '៤'; 
	  }else if(str[i] == '5'){
	    format += '៥'; 
	  }else if(str[i] == '6'){
	    format += '៦'; 
	  }else if(str[i] == '7'){
	    format += '៧'; 
	  }else if(str[i] == '8'){
	    format += '៨'; 
	  }else if(str[i] == '9'){
	    format += '៩'; 
	  }else if(str[i] =="-"){
	    format += '-';
	  }
	}
	return format;


}


