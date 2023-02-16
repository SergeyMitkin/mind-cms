<?php if (isset($_SESSION['answer'])) { ?>
    <div class="<?= $_SESSION['answer']['type'] ?> session-answer">
        <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION['answer']['text']; unset($_SESSION['answer']);?></h4>
        </div>
    </div>
<?php } ?>
<div class="col-sm-12">
    <div class="highlight">
        <span><a href="/menu/admin">Menu</a></span>
    </div>

    <div class="control-links">
        <a href="/menu/admin" class="btn btn-primary<?=(isset($action) && $action == 'index') ? ' active' : '' ?>">
            Список меню
        </a>
        <a href="/menu/admin/listtemplates" class="btn btn-primary<?=(isset($action) && $action == 'listTemplates') ? ' active' : '' ?>">
            Управление шаблонами вывода
        </a>
        <a href="/menu/admin/add" class="btn btn-primary<?=(isset($action) && $action == 'addMenuItem') ? ' active' : '' ?>">
            Cоздать меню
        </a>

        <?if (isset($action) && $action == 'rootMenu'):?>
            <a href="/menu/admin/add/<?= $data['parent_id']; ?>"
               class="btn btn-group-lg btn-success">Добавить новый пункт меню
            </a>
        <?endif;?>
    </div>
</div>

