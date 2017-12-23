$(document).ready(function() {
    $(window).on("scroll", function() {
        if($(window).scrollTop() > 50) {
            $(".site-header").addClass("active");
        } else {
            //remove the background property so it comes transparent again (defined in your css)
            $(".site-header").removeClass("active");
        }
    });
});
