$(document).ready(function (){

    $(".control-links .btn").on('click', function (e){

        if ($(this).hasClass('active')){
            return false;
        }
        // alert('test');
        // e.preventDefault();

    });

});