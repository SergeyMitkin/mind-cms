$(function() {
    $('#subheader').change(function() {
        if ($(this).is(':checked')) {
            $("#link").removeAttr("required");
            $("#link-group").hide();
        } else {
            $("#link").attr("required", "");
            $("#link-group").show();
        }
    });
});