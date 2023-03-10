<?php if (isset($_SESSION['answer'])) { ?>
    <div class="<?= $_SESSION['answer']['type'] ?> session-answer">
        <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION['answer']['text']; unset($_SESSION['answer']);?></h4>
        </div>
    </div>
<?php } ?>

<div class="col-sm-4 pull-left module-title">
    <span><a href="/menu/admin">Menu</a></span>
</div>

<div class="col-sm-8 pull-right" style="text-align: right;">

    <div class="control-links">
        <a href="/menu/admin" class="btn btn-primary<?=(isset($action) && $action == 'index') ? ' active' : '' ?>">
            <?= (isset($action) && $action == 'index') ? 'Список меню':'Вернуться к списку' ?>
        </a>

        <?if (!isset($action) || $action !== 'rootMenu'):?>
            <a href="/menu/admin/add/root" class="btn btn-primary<?=(isset($action) && $action == 'addRootMenu') ? ' active' : '' ?>">
                Создать основное меню
            </a>
        <?endif;?>

        <?if (isset($action) && $action == 'rootMenu'):?>
            <a href="/menu/admin/add/<?= $data['parent_id']; ?>"
               class="btn btn-group-lg btn-success">Добавить новый пункт меню
            </a>
        <?endif;?>
    </div>
</div>

