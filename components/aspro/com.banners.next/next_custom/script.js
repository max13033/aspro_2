$(document).ready(function () {

    var $slider = $('.courusel-with-big-img .first-courusel'),
        $sliderSeconf = $('.courusel-with-big-img .second-courusel'),
		$sliderMobile = $('.courusel-with-big-img .mobile-courusel'),
        $body = $('body'),
        next = false;

	$sliderMobile.owlCarousel({
        items: 2,
        loop: true,
        touchDrag: true,
        autoWidth: false,
        mouseDrag: false,
        nav: false,
        dots: false,
        autoplay: true,
		responsiveRefreshRate: 200,
        autoplayTimeout: 6000,
        autoplayHoverPause: true,
        margin: 3,
        startPosition: 0,
    });

    $slider.owlCarousel({
        items: 1,
        loop: true,
        touchDrag: false,
        mouseDrag: false,
        autoWidth: false,
        nav: false,
        dots: false,
        autoplay: false,
        smartSpeed : 2000,
        margin: 25,
        startPosition: 0,
    });

    $sliderSeconf
        .on('initialized.owl.carousel', function () {
            $sliderSeconf.find(".owl-item").eq(0).addClass("current");
        })
        .owlCarousel({
            items: 2,
            startPosition:1,
            loop: true,
            touchDrag: false,
            mouseDrag: false,
            autoWidth: false,
            nav: true,
            dots: false,
            autoplay: true,
            smartSpeed : 2000,
            responsiveRefreshRate: 200,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            margin: 10,
        }).on('changed.owl.carousel', syncPosition2);


    function syncPosition2(el) {
		var number = next ? el.item.index - 1 : el.item.index + 2;
        if (!next && el.item.count < 3){
			number = el.item.index;
            number += 1;
        }

        $slider.data('owl.carousel').to(number, 2000, true);
    }
    $body.on('click', '.courusel-with-big-img .flex-nav-next a',function(e){
        e.preventDefault();
        next = true;
        $(this).closest('.courusel-with-big-img').find('.second-courusel .owl-prev').click();
    });

    $body.on('click', '.courusel-with-big-img .flex-nav-prev a',function(e){
        e.preventDefault();
        next = false;
        $(this).closest('.courusel-with-big-img').find('.second-courusel .owl-next').click();
    });
    $body.on('mouseenter ', '.courusel-with-big-img .flex-nav-prev a, .courusel-with-big-img .flex-nav-next a',function(e){
        e.preventDefault();
        $sliderSeconf.trigger('stop.owl.autoplay');
    });
    $body.on('mouseleave ', '.courusel-with-big-img .flex-nav-prev a, .courusel-with-big-img .flex-nav-next a',function(e){
        e.preventDefault();
        $sliderSeconf.trigger('play.owl.autoplay',[6000]);
    });

    $('.courusel-with-big-img').removeClass('before-ready-hidden');
});
