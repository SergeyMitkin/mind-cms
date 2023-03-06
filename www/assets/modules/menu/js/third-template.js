$(function(){
    thirdMenuEvent();
    $('.templates-tabs a').on('shown.bs.tab', function(e){
        let template_id = $(e.target).attr("data-id");
        if (template_id === '3') {
            thirdMenuEvent();
        }
    });

    function thirdMenuEvent() {
        $(".third-template-nav li.dropdown > a").each(function(){
            if (!checkEvent($(this), 'touchstart') || !checkEvent($(this), 'click')) {
                $(this).on("touchstart click", function(e){
                    e.preventDefault();
                    if ( $(this).next(".submenu").is(":visible") ){
                        $(this).next(".submenu").hide();
                    } else {
                        $(this).next(".submenu").show();
                    }
                });
            }
        });
    }
});

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