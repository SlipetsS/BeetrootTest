jQuery(document).ready(function($) {
    $(window).bind("scroll", function() {
        if ($(this).scrollTop() > 420) {
            $(".agenda-one-info").addClass('show')
        } else {
            $(".agenda-one-info").removeClass('show')
        }
    });
});