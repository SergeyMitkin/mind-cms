<?php
/**
 * Created by PhpStorm.
 * User: E_dulentsov
 * Date: 09.06.2017
 * Time: 17:01
 */
?>
<div class="row">
    <div class="col-sm-12 panel-heading">
        <?= $data['topmenu']; ?>

        <div class="col-sm-12">
            <div class="panel-body">
                <?php if (!empty($data['listMenus'])) {
                    ?>
                    <table class="table table-bordered table-striped table-hover" id="result">
                        <thead>
                        <tr class="info">
                            <td>№ формы</td>
                            <td>Название меню</td>
                            <td>Управление</td>
                        </tr>
                        </thead>
                        <tbody>
                        <?
                        foreach ($data['listMenus'] as $value) {
                            $message = json_decode($value->name, TRUE);
                        ?>
                        <tr>
                            <td><?= $value->menu_id; ?></td>
                            <td><a href="/menu/admin/listmenu/<?= $value->id; ?>"><?= $value->name . ' ( ' . $value->count . ' )'; ?></a></td>
                            <td>
                                <a href="/menu/admin/edit/root?menu=<?= $value->id; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                <a href="/menu/admin/delete/<?= $value->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Вы уверены, что хотите удалить меню?') ? true : false;"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="warning">Меню на сайте нет! Создать новое меню?</div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="panel row">
    <div class="panel-heading clearfix">
        <div class="pull-left">Меню сайта</div>
        <div class="pull-right">
            <a href="/menu/admin/form/0/ajax" class="btn btn-sm btn-success ajax">
                <i class="fa fa-plus"></i> Создать пункт меню</a>
            <a href="/menu/admin/parameters" class="btn  btn-sm btn-warning"><i class="fa fa-cogs"></i> Настройки</a></div>
    </div>
    <div class="panel-body">
        <div class="col-sm-3">
            <div class="clear clearfix">Поиск<br>
                <input type="text" name="finded" id="finded">
            </div>
            <div class="clear clearfix" id="list_pages">
                <?php \modules\menu\helpers\Nested::printNestedTree($data['admin_menu'], 0, false); ?>
            </div>
        </div>
        <div class="col-sm-9" id="contentZone"></div>
    </div>
</div>

<?
\core\Html::instance()->setCss("/assets/vendors/jstree/themes/default/style.css");
\core\Html::instance()->setJs("/assets/vendors/jstree/jstree.min.js");
\core\Html::instance()->setJs("/assets/modules/menu/js/list.js");
?>
