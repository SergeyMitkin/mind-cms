$(function(){

    // В мобильной версии, подменю открывается при клике
    $('.templates-tabs a').on('shown.bs.tab', function(){
        if ( $(".fourth-menu-mobile").is(":visible") ) {
            console.log('visible');
        }
    });


    $('.fourth-template-navbar li').hover(function() {
        let child_menu = $(this).children('.dropdown-menu');
        child_menu.show();

        if (child_menu.is(":visible")) {
            $(this).addClass('open');

            if ($(this).parent().hasClass('dropdown-menu')) {
                child_menu.attr('style', 'top: 0px; left: ' + $(this).width() + 'px;');
            }
        }
    }, function() {
        if(!$(this).children('.dropdown-menu').is(":visible")){
            $(this).removeClass('open');
        }
    });

});