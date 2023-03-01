$(function(){
    jQuery('.fourth-template-navbar li').hover(function() {

        let child_menu = jQuery(this).children('.dropdown-menu').show();

        if (child_menu.is(":visible")) {
            $(this).addClass('open');

            if ($(this).parent().hasClass('dropdown-menu')) {
                child_menu.attr('style', 'top: 0px; left: ' + $(this).width() + 'px;');
            }
        }
    }, function() {
        if(!jQuery(this).children('.dropdown-menu').hide().is(":visible")){
            $(this).removeClass('open');
        }
    });
});