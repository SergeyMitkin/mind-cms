$(function(){

    // В мобильной версии, подменю открывается при клике
    $('.templates-tabs a').on('shown.bs.tab', function(){

        if ( $(".fourth-menu-mobile").is(":visible") ) {
            $(".fourth-template-navbar li.dropdown > a").on("touchstart click", function(e){
                e.preventDefault();
                fourthSubmenuEvent(this);
            });
        } else {
            $('.fourth-template-navbar li.dropdown').on('mouseover', function() {
                let child_menu = $(this).children('.dropdown-menu');
                $(this).addClass('open');
                if ($(this).parent().hasClass('dropdown-menu')) {
                    child_menu.attr('style', 'display: block; top: 0px; left: ' + $(this).width() + 'px;');
                } else {
                    child_menu.show();
                }
            }).on('mouseleave', function (){
                if(!$(this).children('.dropdown-menu').hide().is(":visible")){
                    $(this).removeClass('open');
                }
            });
        }
    });

    $( window ).resize(function() {
        if ( !$(".fourth-menu-mobile").is(":visible") ) {
            $('.fourth-template-navbar li.dropdown').each(function(){
                if( !checkEvent($(this), 'mouseover') || !checkEvent($(this), 'mouseleave') ) {
                    $(this).on('mouseover', function() {
                        let child_menu = $(this).children('.dropdown-menu');
                        $(this).addClass('open');
                        if ($(this).parent().hasClass('dropdown-menu')) {
                            child_menu.attr('style', 'display: block; top: 0px; left: ' + $(this).width() + 'px;');
                        } else {
                            child_menu.show();
                        }
                    }).on('mouseleave', function (){
                        if(!$(this).children('.dropdown-menu').hide().is(":visible")){
                            $(this).removeClass('open');
                        }
                    });
                }
            });

            $(".fourth-template-navbar li.dropdown > a").each(function () {
                if ( checkEvent($(this), 'click') || checkEvent($(this), 'touchstart') ) {
                    $(this).off("touchstart click");
                }
            });
        } else {
            $('.fourth-template-navbar li.dropdown').each(function (){
                if ( checkEvent($(this), 'mouseover') || checkEvent($(this), 'mouseleave') ){
                    $(this).next(".dropdown-menu").removeAttr('style');
                    $(this).off("mouseover mouseleave");
                }
            });

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

function fourthSubmenuEvent(element){
    if ( $(element).siblings(".dropdown-menu").is(":visible") ){
        $(element).siblings(".dropdown-menu").hide();
    } else {
        $(element).siblings(".dropdown-menu").attr('style', 'display: block;');
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