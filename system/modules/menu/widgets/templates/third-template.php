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

<style>
    .third-template-nav .nav.submenu,
    .third-template-nav .sub-item
    {
        margin: 0 !important;
        padding: 0 !important;
    }

    .third-template-nav li {
        border-width: 1px 1px 0 1px !important;
        border-style: solid !important;
        width: 250px;
    }

    .third-template-nav > li,
    .third-template-nav > noindex > li
    {
        background: #48a7e2;
        border-color: #438bbc !important;
    }

    .third-template-nav li:not(.submenu li):last-child {
        border-width: 1px 1px 1px 1px !important;
    }

    .third-template-nav li a {
        color: #f7f7f7;
        font-weight: 700;
        border-radius: 0 !important;
        display: flex !important;
        justify-content: space-between;
        text-decoration: none;
        padding: 10px 15px;
    }
    .third-template-nav li a:hover,
    .third-template-nav>li>a:focus
    {
        background: #3c98d4 !important;
        color: #f7f7f7 !important;
    }

    .third-template-nav .submenu  li {
        left: -1px;
        background: #424952;
        border-color: #383e47 !important;
        position: relative;
    }
    .third-template-nav .submenu li a:hover,
    .third-template-nav .submenu li a:focus
    {
        background: #45545f !important;
    }

    .third-template-nav li > ul {
        display: none;
    }
</style>