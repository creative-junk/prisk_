function viewMode(mode) {
	
	if(mode == 'list') {	
		jQuery('#vm-products-category .view-mode').find('a').removeClass('active');
		jQuery('.list-product').addClass('vm_list_view');		
		jQuery('#vm-products-category').find('a.mode-list').addClass('active');
	} else {	
		jQuery('#vm-products-category .view-mode').find('a').removeClass('active');
		jQuery('.list-product').removeClass('vm_list_view');		
		jQuery('#vm-products-category').find('a.mode-grid').addClass('active');
	}
}

jQuery(document).ready(function($){
	/* Testimonial Carousel */
	if( $(".testimonial .owl").length ) {
		$(".testimonial .owl").owlCarousel({
			items: 1,
			navigation : false,
			pagination : true,
		});
	}
	
	/* brand Carousel */
	if( $(".brand .owl-carousel").length ) {
		$(".brand .owl-carousel").owlCarousel({
			loop:true,
			margin:10,
			responsiveClass:true,
			navigation: true,
			pagination : false,
			themeClass: 'owl-theme style2',
			items : 5,
			itemsDesktop : [1170,5],
			itemsDesktopSmall : [980,4],
			itemsTablet : [800,4],
			itemsTabletSmall : 	[650,3],
			itemsMobile : [450,2],
		});
	}
	
	/* amazing Carousel */
	if( $(".amazing-works .owl-carousel").length ) {
		$(".amazing-works .owl-carousel").owlCarousel({
			items : 5,
			loop:true,
			responsiveClass:true,
			responsive: true,
			navigation: true,
			pagination : false,
			itemsDesktop : [1170,5],
			itemsDesktopSmall : [980,4],
			itemsTablet : [800,4],
			itemsTabletSmall : 	[650,3],
			itemsMobile : [450,1],
		});
	}
	/*  Page loader */
	if( $('#pageloader').length ) {
		setTimeout(function() {
			$( 'body' ).addClass( 'loaded' );
				setTimeout(function () {
				$('#pageloader').remove();
			}, 1500);
		}, 1500);
	}	

	/* Goto Top */		
	$(window).scroll(function(event) {	
		if ($(this).scrollTop() > 300) {
			$('.sp-totop').fadeIn();
			$('.sp-totop').css({"visibility": "visible"});
		} else {
			$('.sp-totop').fadeOut();
		}
	});
	
	$('.sp-totop').on('click', function() {
        $('html, body').animate({
            scrollTop: $("body").offset().top
        }, 500);
    });
	
	if( $(".vm_category_menu .sp-module-title").length ){		
		$(".vm_category_menu .sp-module-title").on('click', function() {
			$('.vm_category_menu .sp-module-content').slideToggle("show");
		});
	}
	if( $("#login-form .login-title").length ){		
		$("#login-form .login-title").on('click', function() {
			$('#login-form .login-content').slideToggle("show");
		});		
	}
	/* search layout 2*/
	if( $(".sp-vmsearch-slideToggle .slideToggle-open").length ){	
		$(".sp-vmsearch-slideToggle .slideToggle-open").on('click', function() {
			$('.sp-vmsearch-slideToggle .sp-vmsearch-content').slideToggle("show");
		});
	}
	
	
	/* Fix conflict MooTools and Bootstrap */
	var bootstrapLoaded = (typeof $().carousel == 'function');
	var mootoolsLoaded = (typeof MooTools != 'undefined');
	if (bootstrapLoaded && mootoolsLoaded) {
		Element.implement({
			hide: function () {
				return this;
			},
			show: function (v) {
				return this;
			},
			slide: function (v) {
				return this;
			}
		});
	}
	
	/*Fix Carousel*/
	if( $(".carousel").length ){
		$(".carousel").each( function() {
			$(this).parent().addClass("wrap-carousel");
		});
	}
	
	/* Countdown */
	if( $('[data-hot-deal]').length ) {
		$('[data-hot-deal]').each(function() {
			var $this = $(this), 
				finalDate1 = $(this).data('hot-deal');
				$this.countdown(finalDate1, function(event) {
				$this.html(event.strftime('<div class="day box-time-date"><span class="number">%D </span>Days</div><div class="hour box-time-date"><span class="number">%H </span>Hour</div><div class="min box-time-date"><span class="number"> %M</span> Mins</div> <div class="sec box-time-date"><span class="number">%S </span>Secs</div>'));
			});
		});
	}

});

jQuery( window ).scroll(function() {

	if( jQuery(".is-sticky .vm_category_menu .sp-module-content").length ){		
			jQuery('.is-sticky .vm_category_menu .sp-module-content').slideUp("slow");
	}else {
		jQuery('.vm_category_menu .sp-module-content').slideDown("slow")
	}
});
