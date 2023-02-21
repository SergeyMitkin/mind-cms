<div class="row">
    <div class="col-sm-12 panel-heading">
        <?= $data['topmenu']; ?>
        <div class="col-sm-12">
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
                        <?= core\Html::instance()->render(__DIR__ . '\TemplatesList.php', [
                             'menu_id' => $data['menuinfo']->menu_id
                        ]);?>
                    </fieldset>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Сохранить меню</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
