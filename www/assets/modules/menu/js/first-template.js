function showDropdownMenu(el){
    if ( $(el).next(".submenu").is(":visible") ){
        $(el).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
        $(el).next().hide();
    } else {
        $(el).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
        $(el).next().show();
    }
}

$(function (){
   $("li.dropdown a").on("touchstart", function (){
        showDropdownMenu(this);
   }).on("click", function (){
       showDropdownMenu(this);
   });
});