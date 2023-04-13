<?php if (isset($_SESSION['answer'])) { ?>
    <div class="<?= $_SESSION['answer']['type'] ?> session-answer">
        <div class="alert alert-success" role="alert">
            <h4><?=$_SESSION['answer']['text']; unset($_SESSION['answer']);?></h4>
        </div>
    </div>
<?php } ?>

<div class="col-sm-4 pull-left module-title">
    <span><a href="/map/admin">Map</a></span>
</div>

<div class="col-sm-8 pull-right" style="text-align: right;">
    <div class="control-links">
        <a href="/map/admin" class="btn btn-primary<?=(isset($action) && $action == 'index') ? ' active' : '' ?>">
            <?= (isset($action) && $action == 'index') ? 'Список карт':'Вернуться к списку' ?>
        </a>

        <a href="/map/admin/add" class="btn btn-primary<?=(isset($action) && $action == 'add') ? ' active' : '' ?>">
            Создать карту
        </a>
    </div>
</div>

