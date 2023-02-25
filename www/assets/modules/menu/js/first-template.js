

// $(function() {
//     function onNavbar() {
//         if (window.innerWidth >= 768) {
//             $('.first-template-navbar .dropdown').on('mouseenter', function(){
//                 $('.dropdown-toggle', this).next('.submenu').show().find('.submenu').hide();
//             }).on('mouseleave', function(){
//                 $(this).find('.submenu').hide();
//             });
//             $('.dropdown-toggle').click(function() {
//                 if ($(this).next('.submenu').is(':visible')) {
//                     window.location = $(this).attr('href');
//                 }
//             });
//         } else {
//             $('.first-template-navbar .dropdown').off('mouseenter');
//             $('.first-template-navbar .root-dropdown').off('mouseleave');
//         }
//     }
//     $(window).resize(function() {
//         onNavbar();
//     });
//     onNavbar();
// });
// $(function() {
//     function onNavbar() {
//         if (window.innerWidth >= 768) {
//             $('.first-template-navbar .dropdown').on('mouseover', function(e){
//                 $('.dropdown-toggle', this).next('.submenu').show().find('.submenu').hide();
//
//                 if ($(e.target).hasClass('dropdown')) {
//                     $(e.target).children('.submenu').show();
//                 }
//
//             }).on('mouseout', function(e){
//                 console.log($(e.target).hasClass('dropdown'));
//                 if (!$(e.target).hasClass('dropdown') || !$(e.target).closest('li').hasClass('dropdown')) {
//                     $('.dropdown-toggle', this).next('.submenu').hide();
//                 }
//             });
//             $('.dropdown-toggle').click(function() {
//                 if ($(this).next('.submenu').is(':visible')) {
//                     window.location = $(this).attr('href');
//                 }
//             });
//         } else {
//             $('.first-template-navbar .dropdown').off('mouseover').off('mouseout');
//         }
//     }
//     $(window).resize(function() {
//         onNavbar();
//     });
//     onNavbar();
// });