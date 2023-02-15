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
        <a href="/menu/admin" class="btn btn-primary<?=($action == 'index') ? ' active' : '' ?>">
            Список меню
        </a>
        <a href="/menu/admin/listtemplates" class="btn btn-primary<?=($action == 'listtemplates') ? ' active' : '' ?>">
            Управление шаблонами вывода
        </a>
    </div>

</div>

