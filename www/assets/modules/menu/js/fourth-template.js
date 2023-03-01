$(function(){
    jQuery('.fourth-template-navbar li').hover(function() {
        if (jQuery(this).children('.dropdown-menu').show().is(":visible")) {
            $(this).addClass('open');
        }
    }, function() {
        if(!jQuery(this).children('.dropdown-menu').hide().is(":visible")){
            $(this).removeClass('open');
        }
    });
});