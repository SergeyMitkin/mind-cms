<?php

use modules\menu\models\ShowTemplate;

if (!empty($menu)) : ?>

    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <?php $template_model = new ShowTemplate();
            $template_model->showSecondTemplate($menu, $root_id, $parents); ?>
        </ul>
        <div class="second-menu-mobile"></div>
    </nav>

<? else : ?>

    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <li><a href="javascript:void(0)">Menu Item A</a></li>
            <li class="dropdown">
                <a href="javascript:void(0);">
                    <div class="link-name">Menu Item B</div>
                    <div class="triangle-right"></div>
                </a>
                <ul class="nav submenu">
                    <li class="sub-wrap">
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 1.5</a></li>
                        </ul>
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 2.5</a></li>
                        </ul>
                        <ul class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">SUB-HEADER 3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.1</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.2</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.3</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.4</a></li>
                            <li><a href="javascript:void(0)">Menu Link 3.5</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li><a href="javascript:void(0)">Menu Item C</a></li>
            <li><a href="javascript:void(0)">Menu Item D</a></li>
            <li><a href="javascript:void(0)">Menu Item E</a></li>
        </ul>
        <div class="second-menu-mobile"></div>
    </nav>

<?php endif; ?>

<style>
    .second-template-nav .nav.submenu {
        margin: 0 !important;
        padding: 0 !important;
    }

    .second-template-nav li {
        width: 250px;
        background: #303030;
        border-width: 2px 2px 2px 2px !important;
        border-style: solid !important;
        border-color: #232323 !important;
        border-top-color: #4b4b4b !important;
        margin: 0;
        padding: 0;
    }

    .second-template-nav .sub-wrap li {
        background: unset;
    }

    .second-template-nav li.menu-subheader {
        background: #fe8303;
    }
    .second-template-nav li.menu-subheader a:hover {
        cursor: default;
        background: #fe8303 !important;
    }

    .second-template-nav li a {
        color: #f7f7f7;
        font-weight: 700;
        border-radius: 0 !important;
        display: flex !important;
        justify-content: space-between;
        text-decoration: none;
        padding: 10px 15px;
    }
    .second-template-nav li a:hover,
    .second-template-nav li a:focus
    {
        background: #4b4b4b !important;
        color: #f7f7f7 !important;
    }

    .second-template-nav .triangle-right,
    .second-template-nav .triangle-down {
        position: relative;
        width: 20px;
        height: 100%;
    }
    .triangle-right::after {
        content: '';
        position: absolute;
        border: 5px solid transparent;
        border-left: 5px solid #f7f7f7;
        margin: 5px 0;
    }
    .triangle-down::after {
        content: '';
        position: absolute;
        border: 5px solid transparent;
        top: 7px;
        left: -4px;
        border-top: 5px solid #f7f7f7;
    }

    .second-template-nav .submenu {
        position: absolute;
        top: -2px;
        right: -250px;
    }

    .second-template-nav li > .submenu {
        display: none;
    }

    .second-menu-mobile {
        display: block !important;
    }

    @media (max-width: 600px) {
        .second-template-nav .submenu {
            position: relative;
            top: 0;
            right: 2px;
        }

        .second-template-nav li.dropdown:hover > ul {
            display: none;
        }

        .second-template-nav .submenu>li:last-child {
            border-bottom-width: 0 !important;
        }
    }
    @media (min-width: 601px) {
        .second-template-navbar .second-menu-mobile {
            display: none !important;
        }

        .second-template-nav li:hover > .submenu
        {
            display: block !important;
        }

        .second-template-nav .sub-wrap {
            background: #4b4b4b;
            position: absolute;
            display: flex;
            flex-wrap: wrap;
            width: max-content;
            max-width: 600px;
            align-content: flex-start;
            padding-right: 100px;
            padding-bottom: 50px;
            left: -250px;
        }
    }

    .second-template-nav .sub-item {
        margin: 10px !important;
    }

    .second-template-nav .sub-item li {
        border: none !important;
        width: 200px;
    }

    .second-template-nav .sub-item li:not(.menu-subheader) a {
        font-weight: 100;
        justify-content: unset;
    }
    .second-template-nav .sub-item li:not(.menu-subheader) a:hover {
        color: #4b4b4b !important;
    }
    .second-template-nav .sub-item li:not(.menu-subheader) a:before {
        content: "";
        background-image: url("/assets/modules/menu/img/dotted-arrow.png");
        background-repeat: no-repeat;
        background-size: contain;
        width: 20px !important;
        height: 10px !important;
        display: inline-block;
        margin: 5px 0 0 -5px;
    }
</style>
