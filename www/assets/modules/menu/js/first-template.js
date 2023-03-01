$(function (){
   $("li.dropdown a").on("touchstart", function (){
       if ( $(this).next(".submenu").is(":visible") ){
           $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
           $(this).next().hide();
       } else {
           $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
           $(this).next().show();
       }
   });
});