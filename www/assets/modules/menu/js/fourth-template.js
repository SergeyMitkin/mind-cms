$(function(){
    // События прикрепляются к меню либо при загрузке страницы, либо при открытии вкладки с шаблоном
    fourthMenuEvent();
    $('.templates-tabs a').on('shown.bs.tab', function(e){
        let template_id = $(e.target).attr("data-id");
        if (template_id === '4') {
            fourthMenuEvent();
        }
    });

    $( window ).resize(function() {
        if ( !$(".fourth-menu-mobile").is(":visible") ) {
            $(".fourth-template-navbar li.dropdown > a").each(function () {
                if ( checkEvent($(this), 'click') || checkEvent($(this), 'touchstart') ) {
                    $(this).off("touchstart click");
                }
            });
        } else {
            $(".fourth-template-navbar li.dropdown > a").each(function(){
                if (!checkEvent($(this), 'touchstart') || !checkEvent($(this), 'click')) {
                    $(this).on("touchstart click", function(e){
                        e.preventDefault();
                        fourthSubmenuEvent(this);
                    });
                }
            });
        }
    });
});

function fourthMenuEvent() {
    // В мобильной версии, подменю открывается при клике
    if ( $(".fourth-menu-mobile").is(":visible") ) {
        $(".fourth-template-navbar li.dropdown > a").on("touchstart click", function(e){
            e.preventDefault();
            fourthSubmenuEvent(this);
        });
    }
}

function fourthSubmenuEvent(element) {
    if ( $(element).siblings(".dropdown-menu").is(":visible") ){
        $(element).siblings(".dropdown-menu").hide();
    } else {
        $(element).siblings(".dropdown-menu").show();
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