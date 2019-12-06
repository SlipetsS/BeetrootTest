jQuery(document).ready(function($) {

    $(window).bind("scroll", function() {
        if ($(this).scrollTop() > 420) {
            $(".agenda-one-info").addClass('show')
        } else {
            $(".agenda-one-info").removeClass('show')
        }
    });

    $(".nav-menu").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
            top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
    });

    $('.nav-menu li a').on('click', function(){
        $('#menu li.current_page_item').removeClass('current_page_item');
        $(this).addClass('current_page_item');
    });


});