$(document).ready(function() {
// _________________header background ____________________
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 10) {
            $(".site-header").addClass("active");
        } else {
            $(".site-header").removeClass("active");
        }
    });

    // _________________ANIMATION________________________

    $(".brand_new").animated("flash", "fadeOut");
    $(".slogan").animated("fadeInUp", "fadeInDown");
    $(".owl-carousel").animated("zoomIn", "zoomOut");
    $(".hero_shot_spec").animated("flipInX", "flipOutX");
    $(".call_to_action").animated("flipInX", "flipOutX");
    $(".about_full_spec li:nth-child(1) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(2) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(3) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(4) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(5) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(6) p").animated("fadeInUp", "fadeOutUp");
    $(".about_full_spec li:nth-child(7) p").animated("fadeInUp", "fadeOutUp");


});
// __________________Preload __________________________
$(window).on("load", function() {
    $(".loader_inner").fadeOut();
    $(".loader").delay(400).fadeOut("slow");
});
$(function() {
    // clicking the "down" button will make the page scroll to the $elem's height
    $('#nav_down').click(
        function () {
            $('html, body').animate({scrollTop: $(window).height()}, 800);
        }
    );
});


// Owl-Carousel
$(document).ready(function () {
    $('#carousel_1').owlCarousel({
        loop: true,
        margin: 10,
        autoplay: true,
        autoplayTimeout: 10000,
        items: 1,
        itemElement: 'div',
        stageElement: 'div',
        center: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    })
});
