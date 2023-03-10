<?php
    $id = isset($data['menuinfo']) ? $data['menuinfo']->id : 0;
    $menu_id = isset($data['menuinfo']) ? $data['menuinfo']->menu_id : -1;
    $template_id = isset($data['menuinfo']) ? $data['menuinfo']->template_id : 0;
?>

<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="root" id="sumbit_form">
            <fieldset>
                <legend>Основная информация</legend>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Название меню</label>
                    <div class="col-sm-10">
                        <? $value = isset($data['menuinfo']) ? $data['menuinfo']->name : FALSE; ?>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Название меню" required value="<?= $value; ?>">
                        <? if (!empty($data['menuinfo'])) { ?>
                            <input type="hidden" class="form-control" id="name" name="id" value="<?= $data['menuinfo']->id; ?>">
                        <? } ?>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="type" value="root">
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Шаблоны вывода</legend>

                <div class="templates-tabs">
                    <ul class="nav nav-tabs" id="myTab">
                        <li class="<?= ($template_id == 1 || $template_id == 0) ? 'active' : '' ?>"><a href="#first-template" data-id="1" data-toggle="tab">Первый шаблон</a></li>
                        <li class="<?= ($template_id == 2) ? 'active' : '' ?>"><a href="#second-template" data-id="2" data-toggle="tab">Второй шаблон</a></li>
                        <li class="<?= ($template_id == 3) ? 'active' : '' ?>"><a href="#therd-template" data-id="3" data-toggle="tab">Третий шаблон</a></li>
                        <li class="<?= ($template_id == 4) ? 'active' : '' ?>"><a href="#fourth-template" data-id="4" data-toggle="tab">Четвертый шаблон</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="first-template" class="tab-pane<?= ($template_id == 1 || $template_id == 0) ? ' in active' : '' ?>">
                            <h3>Первый шаблон</h3>
                            <div class="template-content">
                                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id,$id,  $children_items, $parents, 'first-template');?>
                            </div>
                        </div>
                        <div id="second-template" class="tab-pane<?= ($template_id == 2) ? ' in active' : '' ?>">
                            <h3>Второй шаблон</h3>
                            <div class="template-content">
                                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id, $id,  $children_items, $parents,'second-template');?>
                            </div>
                        </div>
                        <div id="therd-template" class="tab-pane<?= ($template_id == 3) ? ' in active' : '' ?>">
                            <h3>Третий шаблон</h3>
                            <div class="template-content">
                                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id, $id,  $children_items, $parents,'third-template');?>
                            </div>
                        </div>
                        <div id="fourth-template" class="tab-pane<?= ($template_id == 4) ? ' in active' : '' ?>">
                            <h3>Четвертый шаблон</h3>
                            <div class="template-content">
                                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id,$id,  $children_items, $parents,'fourth-template');?>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="template_id" value="1">
            </fieldset>

            <button type="submit" class="btn btn-success pull-right">Сохранить меню</button>
        </form>
    </div>
</div>
