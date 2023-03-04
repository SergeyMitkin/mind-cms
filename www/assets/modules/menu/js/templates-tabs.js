$(function(){
   // Id шаблона подставляется в форму
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
      let template_id = $(e.target).attr('data-id');
      $('input[name="template_id"]').val(template_id);
   });
});