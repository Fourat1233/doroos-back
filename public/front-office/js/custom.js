	
	/*--------------------------------------
		Fixed Navbar Top
		--------------------------------------*/
	$(document).ready(function() {
		$(document).scroll(function () {
			var scroll = $(this).scrollTop();
			var topDist = $(".navbar").position();
			if (scroll > (topDist.top + 1 )) {
				$(".navbar").addClass("top");
				$(".scroll-to-top").addClass("show");
				
			} else {
				$(".navbar").removeClass("top"); 
				$(".scroll-to-top").removeClass("show"); 
			} 
		}); 
	}); 
	
	/*--------------------------------------
		Scroll To Top
		--------------------------------------*/
	$(".scroll-to-top").click(function(){ 
		window.scrollTo({ top: 0, behavior: 'smooth' });
	});
	
	/*--------------------------------------
		Tooltip
		--------------------------------------*/
	$('a[title]').tooltip();
	
	
	/*--------------------------------------
		checkValidity .... 
			--------------------------------------*/ 
	(function() {
		'use strict';
		window.addEventListener('load', function() {
			var forms = document.getElementsByClassName('needs-validation');
			var validation = Array.prototype.filter.call(forms, function(form) {
				form.addEventListener('submit', function(event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					}
					form.classList.add('was-validated');
				}, false);
			});
		}, false);
	})();
	
	/*--------------------------------------
		Hamburger Button
		--------------------------------------*/ 
	$(document).on('click', '.cta', function () {
        $(this).toggleClass('active')
	});
	
	/*--------------------------------------
		slider-carousel
		--------------------------------------*/
	$('[dir="ltr"] .slider-carousel').owlCarousel({
		animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
		autoplay: true,
		// center: true,
		loop: true,
		items:1,
		margin: 0,
		stagePadding: 0,
		nav: false,
		dots: false,
		rtl:false, 
		responsive:{
			0:{
				items: 1
			},
			600:{
				items: 1
			},
			1000:{
				items: 1
			}
		}
	});
	
	$('[dir="rtl"] .slider-carousel').owlCarousel({
		rtl:true,
		animateOut: 'fadeOut',
	    animateIn: 'fadeIn',
		autoplay: true,
		// center: true,
		loop: true,
		items:1,
		margin: 0,
		stagePadding: 0,
		nav: false,
		dots: false,  
		responsive:{
			0:{
				items: 1
			},
			600:{
				items: 1
			},
			1000:{
				items: 1
			}
		}
	});
	
	