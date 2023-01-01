<?php if (isset($_SESSION['answer'])) { ?>
    <div class="<?= $_SESSION['answer']['type'] ?> session-answer"><div class="alert alert-success" role="alert"><h4><?=
                $_SESSION['answer']['text'];
                unset($_SESSION['answer']);
                ?></h4></div></div> 
<?php } ?>
<div class="col-sm-12">
    <div class="highlight">
        <span><a href="/feedback/admin">Feedback</a></span>
    </div>
    <span class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Управление</button>
        <ul class="dropdown-menu">
            <li><a href="/feedback/admin">Управление обращениями</a></li>
            <li><a href="/feedback/admin/addform">Добавить новую форму обращения</a></li>
            <li><a href="/feedback/admin/listforms">Список форм обращения</a></li>
        </ul>
    </span>
</div>

