$(function (){
    if ( $(".first-menu-mobile").is(":visible") ) {
        $("li.dropdown > a").on("touchstart click", function(e){
            e.preventDefault();
            if ( $(this).siblings(".submenu").is(":visible") ){
                $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
                $(this).siblings(".submenu").hide();
            } else {
                $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
                $(this).siblings(".submenu").show();
            }
        });
    }

    $( window ).resize(function() {
        if ( !$(".first-menu-mobile").is(":visible")) {
            $("li.dropdown > a").off("touchstart click").children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
        } else {
            $("li.dropdown > a").on("touchstart click", function(e){
                e.preventDefault();
                if ( $(this).siblings(".submenu").is(":visible") ){
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
                    $(this).siblings(".submenu").hide();
                } else {
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
                    $(this).siblings(".submenu").show();
                }
            }).each(function (){
                if ( !$(this).siblings(".submenu").is(":visible") ){
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
                } else {
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
                }
            });
        }
    });
});