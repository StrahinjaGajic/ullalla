(function ($){
    "use strict";

    jQuery('nav#dropdown').meanmenu();

    new WOW().init();

    $('[data-toggle="tooltip"]').tooltip();

    $(".product-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 1,
        margin: 20,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsMobile : [767,1]
    });

    $(".all-product-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 4,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3],
        itemsMobile : [767,1]
    });

    $(".featured-product-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 4,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3],
        itemsMobile : [767,1]
    });

    $(".blog-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 3,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,2],
        itemsMobile : [767,1]
    });

    $(".blog-carousel-home-4").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 2,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,2],
        itemsDesktopSmall : [979,2],
        itemsMobile : [767,1]
    });

    $(".brand-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 4,
        pagination:false,
        navigation:false,
        itemsDesktop : [1199,4],
        itemsDesktopSmall : [979,3],
        itemsMobile : [767,1]
    });

    $(".product-sell-carousel").owlCarousel({
        autoPlay: 5000,
        autoplaySpeed: 1500,
        slideSpeed:1500,
        items : 1,
        pagination:false,
        navigation:true,
        /* transitionStyle : "fade", */    /* [This code for animation ] */
        navigationText:["<i class='fa fa-arrow-left'></i>","<i class='fa fa-arrow-right'></i>"],
        itemsDesktop : [1199,1],
        itemsDesktopSmall : [979,1],
        itemsMobile : [767,1]
    });

    $.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 

    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
        });
    });

    $( "#slider-range" ).slider({
       range: true,
       min: 88,
       max: 721,
       values: [ 88, 721 ],
       slide: function( event, ui ) {
        $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
    }
});
    $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
        " - $" + $( "#slider-range" ).slider( "values", 1 ) ); 
    

    $( ".single-zoom-thumb .bxslider" ).bxSlider ({
        slideWidth: 144,
        slideMargin:15,
        minSlides: 3,
        maxSlides: 3,
        pager: false,
        speed: 500,
        pause: 3000,
        mode: 'vertical',
    });

    $("#zoom1").elevateZoom({
        gallery:'gallery_01', 
        cursor: 'pointer',/*cursor: "crosshair",*/
        galleryActiveClass: "active", 
        imageCrossfade: true,
        tint:true,
        tintColour:'#F90',
        tintOpacity:0.4,
    });
    
    
    $(".faq-q").click( function () {
      var container = $(this).parents(".faq-c");
      var answer = container.find(".faq-a");
      var trigger = container.find(".faq-t");

      answer.slideToggle(200);

      if (trigger.hasClass("faq-o")) {
        trigger.removeClass("faq-o");
    }
    else {
        trigger.addClass("faq-o");
    }
}); 
})(jQuery);
 