$(function(){

    $('.templates-tabs a').on('shown.bs.tab', function(){

        if( $(".second-template-navbar").is(":visible") ) {

            $(".second-template-nav li.dropdown > a").on("touchstart click", function(e){
                e.preventDefault();
                if ( $(this).siblings(".submenu").is(":visible") ){
                    $(this).siblings(".submenu").hide();
                    $(this).children(".triangle-down").toggleClass("triangle-down triangle-right");
                } else {
                    $(this).siblings(".submenu").show();
                    $(this).children(".triangle-right").toggleClass("triangle-right triangle-down");
                }
            });
        }
    });

});