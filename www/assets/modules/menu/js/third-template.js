$(function(){

    $(".third-template-nav li.dropdown > a").on("touchstart click", function(e){
        e.preventDefault();

        if ( $(this).siblings(".submenu").is(":visible") ){
            $(this).siblings(".submenu").hide();
        } else {
            $(this).siblings(".submenu").show();
        }

    });

});
