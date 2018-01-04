$(document).ready(function() {
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $(".site-header").addClass("active");
        } else {
            $(".site-header").removeClass("active");
        }
    });
});
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
