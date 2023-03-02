$(function (){
    $("li.dropdown > a").on("touchstart click", function (e){
        e.preventDefault();
        if ( $(this).siblings(".submenu").is(":visible") ){
            $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
            $(this).siblings(".submenu").hide();
        } else {
            $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
            $(this).siblings(".submenu").show();
        }
    });
});