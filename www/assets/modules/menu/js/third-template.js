$(function(){
    thirdMenuEvent();
    $('.templates-tabs a').on('shown.bs.tab', function(e){
        let template_id = $(e.target).attr("data-id");
        if (template_id === 3) {
            thirdMenuEvent();
        }
    });

    function thirdMenuEvent() {
        $(".third-template-nav li.dropdown > a").on("touchstart click", function(e){
            e.preventDefault();
            if ( $(this).siblings(".submenu").is(":visible") ){
                $(this).siblings(".submenu").hide();
            } else {
                $(this).siblings(".submenu").show();
            }
        });
    }
});
