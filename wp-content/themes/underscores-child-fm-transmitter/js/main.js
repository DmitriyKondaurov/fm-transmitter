$(document).ready(function() {
    $(window).scroll(function() {
        if($(window).scrollTop() > 50) {
            $(".site-header").addClass("active");
        } else {
            $(".site-header").removeClass("active");
        }
    });
});
$(window).load(function() {
    $(".loader_inner").fadeOut();
    $(".loader").delay(400).fadeOut("slow");
});
$(function() {
    // clicking the "down" button will make the page scroll to the $elem's height
    $('#nav_down').click(
        function (e) {
            $('html, body').animate({scrollTop: $(window).height()}, 800);
        }
    );
});