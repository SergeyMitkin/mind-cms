<div class="panel">
    <div class="panel-heading clearfix">
        <?= $data['topmenu']; ?>
    </div>

    <?
    $id = isset($data['menuinfo']) && !empty($data['menuinfo']) ? $data['menuinfo']->id : FALSE;
    $parent_id = !empty($data['parent_id']) ? $data['parent_id'] : $data['menuinfo']->parent_id;
    $menu_id = !empty($data['menu_id']) || (isset($data['menu_id']) && $data['menu_id'] == '0') ? $data['menu_id'] : '';
    $name = !empty($data['menuinfo']->name) ? $data['menuinfo']->name : FALSE;
    $link = !empty($data['menuinfo']->url) ? $data['menuinfo']->url : FALSE;
    $noindex = !empty($data['menuinfo']->is_noindex) ? $data['menuinfo']->is_noindex : FALSE;
    $nofollow = !empty($data['menuinfo']->is_nofollow) ? $data['menuinfo']->is_nofollow : FALSE;
    $subheader = !empty($data['menuinfo']->is_subheader) ? $data['menuinfo']->is_subheader : FALSE;
    ?>

    <div class="panel-body">
        <form class="form-horizontal" method="POST" action="" id="sumbit_form">
            <fieldset>
                <legend>Основная информация</legend>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">Название пункта меню</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Название меню" value="<?= $name; ?>" required>
                    </div>
                </div>
                <div id="link-group" class="form-group"<?= !$subheader ? '' : ' style="display:none"'; ?>>
                    <label for="link" class="col-sm-2 control-label">Ссылка</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="link" name="url" placeholder="Ссылка на меню" value="<?= $link; ?>"<?= !$subheader ? ' required' : ''; ?>>
                    </div>
                </div>
                <div class="">
                    <label for="noindex" class="col-sm-2 control-label">
                        <input id="noindex" type="checkbox" class="" name="is_noindex" value="1" <?= $noindex ? 'checked' : ''; ?>> -
                        Noindex
                    </label>
                    <label for="nofollow" class="col-sm-2 control-label">
                        <input id="nofollow" type="checkbox" class="" name="is_nofollow" value="1"<?= $nofollow ? 'checked' : ''; ?>> -
                        nofollow
                    </label>
                    <label for="subheader" class="col-sm-2 control-label">
                        <input id="subheader" type="checkbox" class="" name="is_subheader" value="1"<?= $subheader ? 'checked' : ''; ?>> -
                        subheader
                    </label>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="type" value="child">
                        <input type="hidden" class="form-control" name="parent_id" value="<?= $parent_id; ?>">
                        <input type="hidden" class="form-control" name="menu_id" value="<?= $menu_id; ?>">
                        <input type="hidden" class="form-control" name="id" value="<?= $id; ?>">
                    </div>
                </div>
            </fieldset>

            <button type="submit" class="btn btn-success pull-right">Сохранить меню</button>

        </form>
    </div>
</div>

