<div class="row">
    <div class="col-sm-12 panel-heading">
        <?= $data['topmenu']; ?>
        <?
        $id = isset($data['menuinfo']) && !empty($data['menuinfo']) ? $data['menuinfo']['id'] : FALSE;
        $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : FALSE;
//        $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : $data['menuinfo']['parent_id'];
        $menu_id = !empty($data['menu_id']) || (isset($data['menu_id']) && $data['menu_id'] == '0') ? $data['menu_id'] : '';
        $name = !empty($data['menuinfo']['name']) ? $data['menuinfo']['name'] : FALSE;
        $link = !empty($data['menuinfo']['link']) ? $data['menuinfo']['link'] : FALSE;
        $icon = !empty($data['menuinfo']['icon']) ? $data['menuinfo']['icon'] : FALSE;
        $noindex = !empty($data['menuinfo']['noindex']) ? $data['menuinfo']['noindex'] : FALSE;
        $nofollow = !empty($data['menuinfo']['nofollow']) ? $data['menuinfo']['nofollow'] : FALSE;
        ?>
        <div class="col-sm-12">

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="add" id="sumbit_form">
                    <fieldset>
                        <legend>Основная информация</legend>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Название пункта меню</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" placeholder="Название меню" value="<?= $name; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="link" class="col-sm-2 control-label">Ссылка</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="link" placeholder="Ссылка на меню" value="<?= $link; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="icon" class="col-sm-2 control-label">Иконка</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="icon" name="icon" placeholder="Glyphicons" value="<?= $icon; ?>">
                            </div>
                        </div>
                        <div class="">
                            <label for="noindex" class="col-sm-2 control-label"><input type="checkbox" class="" name="noindex" value="1" <?= $noindex ? 'checked' : ''; ?>> -
                                Noindex</label>
                            <label for="nofollow" class="col-sm-2 control-label">
                                <input type="checkbox" class="" name="nofollow" value="1"<?= $nofollow ? 'checked' : ''; ?>> -
                                nofollow</label>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="hidden" class="form-control" name="type" value="children">
                                <input type="hidden" class="form-control" name="parent_id" value="<?= $parent_id; ?>">
                                <input type="hidden" class="form-control" name="menu_id" value="<?= $menu_id; ?>">
                                <input type="hidden" class="form-control" name="id" value="<?= $id; ?>">
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-right">Сохранить меню</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
