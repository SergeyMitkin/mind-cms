$(function(){
    jQuery('.fourth-template-navbar li').hover(function() {
        jQuery(this).children('.dropdown-menu').stop(true, true).show();
    }, function() {
        jQuery(this).children('.dropdown-menu').stop(true, true).delay(200).hide();
    });
});