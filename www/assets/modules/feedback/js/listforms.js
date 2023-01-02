$(document).ready(function () {
    $("#result .form-item").on('click', function (){
        let form_id = $(this).attr('data-id');
        $(".test-input").text(form_id);
    });
});