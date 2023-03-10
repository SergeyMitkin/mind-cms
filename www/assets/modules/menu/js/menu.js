$(document).ready(function () {
    $('#result').on('click', '.change_status', function () {
        var $this = $(this);
        var news_id = $this.data('id');
        var status = $this.data('current');
        var icon = $this.children('.glyphicon');
        $.ajax({
            type: 'post',
            url: '/menu/admin/changevisible',
            data: {id: news_id, status: status},
            _obj: icon,
            success: function (data) {
                if (data == 'ok') {
                    this._obj.attr('class', (status == 1 ? 'glyphicon glyphicon-eye-close' : 'glyphicon glyphicon-eye-open'));
                    $this.data('current', (status == 1 ? '0' : '1'));
                }
            }
        })
    });
    $("#result").sortable({
        onDrop: function ($item, container, _super) {
            var arr = [];
            $($item).parent().find('>li').each(function (indx, element) {
                arr[arr.length] = $(element).attr('data-id');
            });
            var parentID = $($item).parents('.list-group-item').data('id') || $($item).parents('#result').data('id');
            $.ajax({
                data: {positions: arr, parentID: parentID},
                type: 'POST',
                url: '/menu/admin/updatesort'
            });
            _super($item, container);
        }
    });
});
$(window).load(function () {
    $('.row .text-success').fadeOut(4500);
});