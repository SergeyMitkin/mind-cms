<?php

use modules\menu\models\ShowTemplate;

if (!empty($menu)) : ?>
    <nav class="navbar third-template-navbar">
        <ul class="nav third-template-nav">
            <?php $template_model = new ShowTemplate();
            $template_model->showThirdTemplate($menu, $root_id, $parents); ?>
        </ul>
    </nav>

<?php else : ?>

    <nav class="navbar third-template-navbar">
        <ul class="nav third-template-nav">
            <li><a href="javascript:void(0)">Главная</a></li>
            <li class="dropdown">
                <a href="javascript:void(0);">
                    <div class="link-name">Каталог</div>
                    <div class="fa-angle-wrap">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                </a>
                <ul class="nav submenu">
                    <li class="dropdown">
                        <a href="javascript:void(0);">
                            <div class="link-name">Смартфоны</div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav submenu">
                            <li><a href="javascript:void(0)">Sumsung</a></li>
                            <li><a href="javascript:void(0)">Sony</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0);">
                            <div class="link-name">Планшеты</div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav submenu">
                            <li><a href="javascript:void(0)">Apple</a></li>
                            <li><a href="javascript:void(0)">Asus</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="javascript:void(0)">О магазине</a></li>
            <li><a href="javascript:void(0)">Контакты</a></li>
        </ul>
    </nav>

<?php endif; ?>
