$(function(){

    // В мобильной версии, подменю открывается при клике
    $('.templates-tabs a').on('shown.bs.tab', function(){
        if( $(".second-template-navbar").is(":visible") ) {
            $(".second-template-nav li.dropdown > a").on("touchstart click", function(e){
                e.preventDefault();
                secondSubmenuEvent(this);
            });
        }
    });

    $( window ).resize(function() {
        if ( !$(".second-menu-mobile").is(":visible")) {
            $(".second-template-nav li.dropdown > a").each(function () {
                if ( checkEvent($(this), 'click') || checkEvent($(this), 'touchstart') ) {
                    $(this).off("touchstart click");
                }
                if ( $(this).children(".triangle-down").length !== 0 ) {
                    $(this).children(".triangle-down").toggleClass("triangle-down triangle-right");
                }
            });
        } else {
            $(".second-template-nav li.dropdown > a").each(function(){
                if (!checkEvent($(this), 'touchstart') || !checkEvent($(this), 'click')) {
                    $(this).on("touchstart click", function(e){
                        e.preventDefault();
                        secondSubmenuEvent(this);
                    });
                }
                if ( !$(this).siblings(".submenu").is(":visible") ){
                    $(this).children(".triangle-down").toggleClass("triangle-down triangle-right");
                } else {
                    $(this).children(".triangle-right").toggleClass("triangle-right triangle-down");
                }
            });
        }
    });
});

function secondSubmenuEvent(element){
    if ( $(element).siblings(".submenu").is(":visible") ){
        $(element).children(".triangle-down").toggleClass("triangle-down triangle-right");
        $(element).siblings(".submenu").hide();
    } else {
        $(element).children(".triangle-right").toggleClass("triangle-right triangle-down");
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