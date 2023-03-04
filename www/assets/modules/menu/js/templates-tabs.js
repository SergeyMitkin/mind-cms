$(function(){
   // Id шаблона подставляется в форму
   console.log('test');
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {

      console.log(e.target);
      e.target // activated tab
      e.relatedTarget // previous tab
   });
});