
<div class="templates-tabs">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#first-template" data-toggle="tab">Первый шаблон</a></li>
        <li><a href="#second-template" data-toggle="tab">Второй шаблон</a></li>
        <li><a href="#therd-template" data-toggle="tab">Третий шаблон</a></li>
        <li><a href="#fourth-template" data-toggle="tab">Четвертая ссылка</a></li>
    </ul>

    <div class="tab-content">
        <div id="first-template" class="tab-pane fade in active">
            <h3>Первый шаблон</h3>
            <div class="template-content">
                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id, 'first-template');?>
            </div>
        </div>
        <div id="second-template" class="tab-pane fade">
            <h3>Второй шаблон</h3>
            <div class="template-content">
                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id, 'second-template');?>
            </div>
        </div>
        <div id="therd-template" class="tab-pane fade">
            <h3>Третий шаблон</h3>
            <div class="template-content">
                <?= \modules\menu\widgets\Widget::instance()->showMenu($menu_id, 'third-template');?>
            </div>
        </div>
        <div id="fourth-template" class="tab-pane fade">
        <h3>Четвертый заголовок</h3>
        <?= core\Html::instance()->render(__DIR__ . '\..\widgets\templates\test.php');?>

        <div id="fifth-template" class="tab-pane fade">
            <h3>Пятый шаблон</h3>
            <div class="template-content">
                <?= core\Html::instance()->render(__DIR__ . '\..\widgets\templates\test.php');?>
            </div>
        </div>
    </div>
</div>

