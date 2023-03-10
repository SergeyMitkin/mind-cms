<?php

namespace modules\menu\models;

if (!empty($menu)) : ?>
    <nav class="navbar fourth-template-navbar">
        <div class="container-fluid">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="navbar-main">
                <ul class="fourth-template-nav nav navbar-nav">
                    <?php $template_model = new ShowTemplate();
                    $template_model->showFourthTemplate($menu, $root_id, $parents); ?>
                </ul>
            </div>
        </div>
        <div class="fourth-menu-mobile"></div>
    </nav>

<? else : ?>

<nav class="fourth-template-navbar navbar">
    <div class="container-fluid">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li><a href="javascript:void(0)"><i class="fa fa-home" aria-hidden="true"></i>ГЛАВНАЯ</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)"><i class="fa fa-table" aria-hidden="true"></i>ПРОДУКЦИЯ</a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">BEST DINNER</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0)">СЧАЧТЛИВЫЙ ПЁС</a>
                            <ul class="nav dropdown-menu">
                                <li><a href="javascript:void(0)">СУХИЕ КОРМА</a></li>
                                <li><a href="javascript:void(0)">ВЛАЖНЫЕ КОРМА</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0)">HOLISTYC BLEND</a></li>
                        <li><a href="javascript:void(0)">НАПОЛНИТЕЛИ DR.ELSEY'S</a></li>
                    </ul>
                </li>
                <li><a href="javascript:void(0)"><i class="fa fa-newspaper-o" aria-hidden="true"></i>НОВОСТИ</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-users" aria-hidden="true"></i>НАША КОМАНДА</a></li>
                <li><a href="javascript:void(0)"><i class="fa fa-map-marker" aria-hidden="true"></i>КОНТАКТЫ</a></li>
            </ul>
        </div>
    </div>
    <div class="fourth-menu-mobile"></div>
</nav>

<?php endif; ?>

<style>
    .fourth-template-navbar .navbar-collapse {
        margin-left: 0 !important;
    }

    .fourth-template-navbar .navbar-collapse.collapse.in > .navbar-nav,
    .fourth-template-navbar .navbar-collapse.collapsing > .navbar-nav
    {
        margin-left: -15px !important;
    }

    .fourth-template-navbar button {
        border: 2px solid #aeb8c2;
    }

    .fourth-template-navbar .icon-bar {
        background-color: #aeb8c2;
    }

    .fourth-template-navbar.navbar {
        background-color: #576472;
        border: unset;
        border-radius: 0;
        font-family: sans-serif;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .fourth-template-navbar .navbar-nav {
        margin: 0 !important;
        padding: 0 !important;
        float: unset;
    }

    .fourth-template-navbar .navbar-nav .fa {
        margin-right: 3px;
    }

    .fourth-template-navbar .navbar-nav > noindex > li {
        display: table;
    }

    .fourth-template-navbar .navbar-nav > noindex,
    .fourth-template-navbar .navbar-nav > noindex > li > a
    {
        float: left;
    }

    .fourth-template-navbar .navbar-nav > li a,
    .fourth-template-navbar .navbar-nav > noindex > li a
    {
        color: #fff !important;
        padding: 20px 25px !important;
    }

    .fourth-template-navbar .navbar-nav > li.open > a,
    .fourth-template-navbar .navbar-nav > noundex > li.open > a
    {
        background-color: #46505b !important;
    }

    .fourth-template-navbar .navbar-nav > li a:hover,
    .fourth-template-navbar .navbar-nav > noindex > li a:hover {
        background-color: #46505b;
        color: #fff;
        border-radius: 0 !important;
    }

    .fourth-template-navbar li ul.dropdown-menu {
        margin: 0 !important;
        padding: 0 !important;
        border: unset;
        border-radius: 0;
    }

    .fourth-template-navbar li > ul.dropdown-menu {
        display: none;
    }

    .fourth-template-navbar li > ul {
        background-color: #384049 !important;
    }

    .fourth-template-navbar li > ul a:hover {
        background-color:  #323a42 !important;
    }

    .fourth-template-navbar li > ul a:hover {
        background-color: #323a42 !important;
    }

    .fourth-template-navbar li > ul > li.open a {
        background-color: #323a42 !important;
    }

    .fourth-template-navbar .dropdown-menu li {
        position: relative;
    }

    .fourth-template-navbar .dropdown-menu li a{
        color: #fff;
    }

    .fourth-template-navbar .dropdown-menu ul {
        position: absolute;
    }

    .fourth-template-navbar .dropdown-menu .dropdown-menu {
        border-width: 0 0 0 4px;
        border-style: solid;
        border-color: #576472;
    }

    .fourth-template-navbar .dropdown-menu .dropdown-menu li a {
        background-color: #323a42 !important;
    }

    .fourth-template-navbar .sub-item {
        margin: 0 !important;
    }

    @media (min-width: 768px) {
        .fourth-menu-mobile {
            display: none;
        }
        .fourth-template-navbar li:hover > .dropdown-menu,
        .fourth-template-navbar li:hover > .dropdown-menu a {
            display: block !important;
        }

        .fourth-template-navbar .dropdown-menu .dropdown-menu {
            top: 0;
            left: 100%;
        }
    }
    @media (max-width: 767px) {
        .fourth-menu-mobile {
            display: block;
        }

        .fourth-template-navbar ul.dropdown-menu {
            position: relative;
            width: 100%;
        }

        .fourth-template-navbar .navbar-nav > noindex {
            width: 100%;
        }

        .fourth-template-navbar .navbar-nav > noindex > li {
            width: inherit;
        }

        .fourth-template-navbar a {
            display: block;
            width: 100%;
        }
    }
</style>