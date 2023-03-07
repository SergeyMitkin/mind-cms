<?php
/**
 * Created by PhpStorm.
 * User: E_dulentsov
 * Date: 09.06.2017
 * Time: 17:01
 */
?>

<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <div class="panel-body">
        <?php if (!empty($data['listMenus'])) { ?>
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

<?
\core\Html::instance()->setCss("/assets/vendors/jstree/themes/default/style.css");
\core\Html::instance()->setJs("/assets/vendors/jstree/jstree.min.js");
\core\Html::instance()->setJs("/assets/modules/menu/js/list.js");
?>
