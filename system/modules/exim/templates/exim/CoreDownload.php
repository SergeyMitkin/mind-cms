<?php
include __DIR__.'/Menu.php';
?>
<div class="panel">
    <div class="panel-heading clearfix">
        <div class="col-sm-12">
            <div class="col-sm-4 pull-left">Обновления ядра. Текущая версия: <?= (isset($data['EximConfig']['version']))?$data['EximConfig']['version']:'неизвестно' ?></div>
            <div class="col-sm-8 pull-right"></div>
        </div>
    </div>
    <?php
    if(isset($data['supportSettings']->token)){
    ?>
        <div class="panel-body">
            <table class="table table-striped table-hover table-bordered responsive TableCoreServer">
                <thead>
                <tr>
                    <th>Название</th>
                    <th width="200" data-orderable="false">Управление</th>
                </tr>
                </thead>
            </table>
        </div>
        <?
    }
    ?>
</div>


<div class="modal fade" id="Form">
    <div class="modal-dialog modal-lg modal-full" style="height: 100%;">
        <div class="modal-content" style="height: 90%; overflow-y: scroll;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="ContentTitle"></h4>
            </div>
            <div class="modal-body clearfix" id="AjaxContent">

            </div>
        </div>
    </div>
</div>
