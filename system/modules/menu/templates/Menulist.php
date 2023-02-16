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
                            <td><?= $value->id; ?></td>
                            <td><a href="/menu/admin/ListMenu/<?= $value->id; ?>"><?= $value->name . ' ( ' . $value->count . ' )'; ?></a></td>
                            <td>
                                <a href="/menu/admin/delete/<?= $value->id; ?>" class="btn btn-xs btn-danger" onclick="return confirm('Вместе с удалением формы, удалятся также и все Feedbacks, Вы уверены?') ? true : false;"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                <?php } else { ?>
                    <div class="warning">Обращений нет!</div>
                <?php } ?>
            </div>
        </div>



<!--        <div class="main-info">-->
<!--            <div class="panel-body">-->
<!---->
<!--                --><?// if (!empty($data['listmenus'])) { ?>
<!--                    <table class="table table-bordered table-striped table-hover" id="result">-->
<!--                        <thead>-->
<!--                        <tr class="info">-->
<!--                            <td>№ </td>-->
<!--                            <td>Название меню</td>-->
<!--                            <td>Управление</td>-->
<!--                        </tr>-->
<!--                        </thead>-->
<!--                        <tbody>-->
<!--                        --><?// foreach ($data['listmenus'] as $value) { ?>
<!--                        <tr>-->
<!--                            <td>--><?//= $value['menu_id']; ?><!--</td>-->
<!--                            <td><a href="/--><?//= $this->app->url['way'][0]; ?><!--/admin/listmenu/--><?//= $value['id']; ?><!--">--><?//= $value['name'] . ' ( ' . $value['count'] . ' )'; ?><!--</a></td>-->
<!--                            <td>-->
<!--                                <a href="/--><?//= $this->app->url['way'][0]; ?><!--/admin/edit/root?menu=--><?//= $value['id']; ?><!--" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>-->
<!--                                <a href="/--><?//= $this->app->url['way'][0]; ?><!--/admin/delete/--><?//= $value['id']; ?><!--" class="btn btn-xs btn-danger" onclick="return confirm('Вместе с корневым удалятся его пункты меню. Уверены?') ? true : false;"><i class="fa fa-trash-o"></i></a>-->
<!--                            </td>-->
<!--                            --><?// } ?>
<!--                        </tr>-->
<!--                        </tbody>-->
<!--                    </table>-->
<!--                --><?// } else { ?>
<!--                    <div class="warning">Меню на сайте нет! Создать новое меню?</div>-->
<!--                --><?// } ?>
<!--            </div>-->
<!--        </div>-->
    </div>
</div>

<?
\core\Html::instance()->setCss("/assets/vendors/jstree/themes/default/style.css");
\core\Html::instance()->setJs("/assets/vendors/jstree/jstree.min.js");
\core\Html::instance()->setJs("/assets/modules/menu/js/list.js");
?>
