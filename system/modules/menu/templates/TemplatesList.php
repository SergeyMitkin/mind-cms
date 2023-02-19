<?
use core\Html;
?>

<div class="row">
    <div class="col-sm-12 panel-heading">
        <?= $data['topmenu']; ?>
        <div class="col-sm-12 panel-body clearfix">

            <div class="templates-tabs">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#first-template" data-toggle="tab">Первый шаблон</a></li>
                    <li><a href="#second-template" data-toggle="tab">Вторая ссылка</a></li>
                    <li><a href="#therd-template" data-toggle="tab">Третья ссылка</a></li>
                    <li><a href="#fourth-template" data-toggle="tab">Четвертая ссылка</a></li>
                </ul>

                <div class="tab-content">
                    <div id="first-template" class="tab-pane fade in active">
                        <h3>Первый шаблон</h3>
                        <div class="template-content">
                            <?= Html::instance()->render(__DIR__ . '\..\widgets\templates\first-template.php');?>
                        </div>
                    </div>
                    <div id="second-template" class="tab-pane fade">
                        <h3>Второй шаблон</h3>
                        <div class="template-content">
                            <?= Html::instance()->render(__DIR__ . '\..\widgets\templates\test.php');?>
                        </div>
                    </div>
                    <div id="therd-template" class="tab-pane fade">
                        <h3>Третий заголовок</h3>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis
                            nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </p>
                    </div>
                    <div id="fourth-template" class="tab-pane fade"">
                    <h3>Четвертый заголовок</h3>
                    <?= Html::instance()->render(__DIR__ . '\..\widgets\templates\test.php');?>
                </div>
            </div>
        </div>
    </div>
</div>