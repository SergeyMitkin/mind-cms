<?php $model = $data['model']; ?>
<div class="row">
    <div class="col-sm-12 panel-heading">
            <?= $data['topmenu']; ?>    
        <div class="col-sm-12">
            <div class="panel-heading">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="/feedback/admin/addform" id="sumbit_form">
                        <input type="hidden" name="id" value="<?= $model->id; ?>">
                        <fieldset>
                            <legend>Данные формы</legend>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Название Формы</label>
                                <div class="col-sm-10">
                                    <?php $name = 'name'; ?>
                                    <input type="text" class="form-control" name="<?= $name; ?>" value="<?= $model->$name; ?>" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Email уведомлений</label>
                                <div class="col-sm-10">
                                    <?php $name = 'email'; ?>
                                    <input type="text" class="form-control" name="<?= $name; ?>" value="<?= $model->$name; ?>"  >
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="input_fields_wrap">
                            <legend>Поля формы</legend>
<!--                            <div class="form-group">-->
<!--                                <label for="name" class="col-sm-2 control-label">Название поля</label>-->
<!--                                <div class="col-sm-8">-->
<!--                                    <input type="text" class="form-control" name="fields[0][name]" >-->
<!--                                </div>-->
<!--                                <div class="col-sm-2"><button class="add_field_button">Добавить поле</button></div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label for="name" class="col-sm-2 control-label">Input name</label>-->
<!--                                <div class="col-sm-8">-->
<!--                                    <input type="text" class="form-control" name="fields[0][name_in_form]" >-->
<!--                                </div>-->
<!--                            </div>-->
                            <div id="contentZone">
                                <div id="ContentZoneInForm"></div>
                            </div>
                            <link rel='stylesheet' href='/assets/modules/feedback/js/builder.css?v=21'>
                            <script defer src='/assets/modules/feedback/js/builder.js?v=21'></script>

                            <?php
                                $fields = json_decode($model->fields, true);
                                if(is_array($fields)){
                                    foreach($fields as $field){
                                        $keyFils=rand(10000, 99999);
                                        ?>
                                        <div class="additional_field"><hr>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Название поля</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fields[<?= $keyFils ?>][name]" value="<?= $field['name'] ?>">
                                                </div><a href="#" class="remove_field">Удалить</a>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Input name</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fields[<?= $keyFils ?>][name_in_form]" value="<?= $field['name_in_form'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <?
                                    }
                                }
                            ?>
                        </fieldset>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success pull-right">Сохранить форму</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", GO);

    function GO() {
        let builder = EMB(document.getElementById('ContentZoneInForm'));
        <?php if(!empty($data->content)){

        ?>
        builder.setData(<?=$data->content;?>);
        <?
        }
        ?>
        // setTimeout(function () {
        //
        //
        //     if (CKEDITOR) {
        //         let fields = document.querySelectorAll("div[contenteditable]");
        //         let conf = {
        //             disableNativeSpellChecker: false,// отключает запрет на стандартную проверку орфографии браузером
        //             extraPlugins: 'sourcedialog',
        //             removeButtons: 'source, Print,Form,TextField,Textarea,radio, checkbox,imagebutton,Button,SelectAll,Select,HiddenField',
        //             removePlugins: 'source, spellchecker, Form, TextField,Textarea, Button, Select, HiddenField , about, save, newpage, print,exportpdf, templates, scayt, flash, pagebreak, smiley,preview,find',
        //             filebrowserBrowseUrl: '/assets/vendors/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        //             filebrowserUploadUrl: '/assets/vendors/filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        //             filebrowserImageBrowseUrl: '/assets/vendors/filemanager/dialog.php?type=1&editor=ckeditor&fldr=',
        //         };
        //         for (const el of fields) {
        //
        //             CKEDITOR.inline(el, conf);
        //         }
        //     } else {
        //         console.log('noEditor');
        //     }
        // }, 1000);
        // /*
        //  * ссылка
        //  */
        // var url = document.getElementById('url');
        // var counter = document.getElementById('numtypes');
        // counter.innerHTML = url.value.length;
        //
        // function showCount() {
        //     counter.innerHTML = url.value.length;
        // }
        //
        // url.onChange = url.onkeydown = url.onblur = url.onfocus = showCount;
        // /*
        //  * Заголовок
        //  */
        // var title = document.getElementById('title');
        // var tcounter = document.getElementById('numtypestitle');
        // tcounter.innerHTML = title.value.length;
        //
        // function showTitleCount() {
        //     tcounter.innerHTML = title.value.length;
        // }
        //
        //
        // title.onChange = title.onkeydown = title.onblur = title.onfocus = showTitleCount;
        // /*
        //  * Отправка формы на сервер ajax! Она уже пашет не как ajax а это добавляет аякс
        //  */
        // $("#PageForm").submit(function (e) {
        //
        //     var btn = $(document.activeElement, this).attr('id');
        //     e.preventDefault();
        //     let d = new FormData(this);
        //     var href = $(this).attr('action');
        //     //var d = $(this).serialize();
        //     d.append('content', JSON.stringify(builder.getData()));
        //     //console.log(d);
        //     /**  @#$%^&*()_!@#$%^&*()_+%$^%&*   */
        //
        //     $.ajax({
        //         type: "POST",
        //         url: href,
        //         data: d,
        //         processData: false,
        //         contentType: false,
        //         success: function (msg) {
        //             var result = JSON.parse(msg);
        //             if (result.error == 0) {
        //                 if (btn == 'sendAndOut') {
        //                 }
        //                 if (btn == 'sendAndStop') {
        //                     $("#PageForm").append('<input type="hidden" name="id" value="' + result.data.id + '">');
        //                     $('#url').val(result.data.url);
        //                     $.toast({
        //                         heading: 'Успешно!',
        //                         text: 'Внесенные изменения сохранены!',
        //                         position: 'top-right',
        //                         icon: 'success'
        //                     });
        //
        //                 }
        //                 listing.jstree('refresh');
        //             } else {
        //                 $.toast({
        //                     heading: 'ОШИБКА!',
        //                     text: 'Что то пошло не так!',
        //                     position: 'top-right',
        //                     icon: 'danger'
        //                 });
        //             }
        //         }
        //     });
        //     return false;
        // });
    };
</script>