$(function (){

    firstMenuEvent();
    $('.templates-tabs a').on('shown.bs.tab', function(e){
        let template_id = $(e.target).attr("data-id");
        if (template_id === '1') {
            firstMenuEvent();
        }
    });

    $( window ).resize(function() {
        if ( !$(".first-menu-mobile").is(":visible")) {
            $(".first-template-nav li.dropdown > a").each(function () {
                if ( checkEvent($(this), 'click') || checkEvent($(this), 'touchstart') ) {
                    $(this).off("touchstart click");
                }
                if ( $(this).find(".fa-angle-wrap i").hasClass('fa-angle-double-down') ) {
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
                }
            });
        } else {
            $(".first-template-nav li.dropdown > a").each(function(){
                if ( !checkEvent($(this), 'touchstart') || !checkEvent($(this), 'click') ) {
                    $(this).on("touchstart click", function(e){
                        e.preventDefault();
                        firstSubmenuEvent(this);
                    });
                }
                if ( !$(this).siblings(".submenu").is(":visible") ){
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
                } else {
                    $(this).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
                }
            });
        }
    });
});

function firstMenuEvent(){
    if ( $(".first-menu-mobile").is(":visible") ) {
        // В мобильной версии, подменю открывается при клике
        $(".first-template-nav li.dropdown > a").on("touchstart click", function(e){
            e.preventDefault();
            firstSubmenuEvent(this);
        });
    }
}

function firstSubmenuEvent(element){
    if ( $(element).siblings(".submenu").is(":visible") ){
        $(element).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-right\" aria-hidden=\"true\"></i>");
        $(element).siblings(".submenu").hide();
    } else {
        $(element).children(".fa-angle-wrap").html("<i class=\"fa fa-angle-double-down\" aria-hidden=\"true\"></i>");
        $(element).siblings(".submenu").show();
    }
}

function eventsList(element) {
    // В разных версиях jQuery список событий получается по-разному
    var events = element.data('events');
    if (events !== undefined) return events;

    events = $.data(element, 'events');
    if (events !== undefined) return events;

    events = $._data(element, 'events');
    if (events !== undefined) return events;

    events = $._data(element[0], 'events');
    if (events !== undefined) return events;

    return false;
}

/**
 * Проверить есть ли событие eventname на элементе element
 * @param object element jQuery-элемент
 * @param string eventname название события
 * @returns bool
 */
function checkEvent(element, eventname) {
    var events,
        ret = false;

    events = eventsList(element);
    if (events) {
        $.each(events, function(evName, e) {
            if (evName == eventname) {
                ret = true;
            }
        });
    }

    return ret;
}