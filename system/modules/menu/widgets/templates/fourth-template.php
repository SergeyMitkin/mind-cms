
<?php
//if (!empty($menu)) : ?>
<!--    <nav class="navbar third-template-navbar">-->
<!--        <ul class="nav third-template-nav">-->
<!--            --><?php //function showFourthTemplate($menu, $root_id, $parents) {
//            $sub_index = 0;
//            foreach ($menu as $item) {
//            if ($item['parent_id'] == $root_id
//            && array_search($item['id'], $parents) === false
//            && $item['is_subheader']){
//            if($sub_index !== 0) {?>
<!--                </div>-->
<!--            --><?//}?>
<!--            --><?// if ($sub_index == 0) {?>
<!--            <div class="sub-wrap">-->
<!--                <div class="nav sub-item">-->
<!--                    <li class="menu-subheader"><a href="javascript:void(0)">--><?//= $item['name'] ?><!--</a></li>-->
<!--                    --><?//} else if ($sub_index > 0){?>
<!--                    <div class="nav sub-item">-->
<!--                        <li class="menu-subheader"><a href="javascript:void(0)">--><?//= $item['name'] ?><!--</a></li>-->
<!--                        --><?//}?>
<!--                        --><?// $sub_index++;
//                        if ($sub_index > 0 && $sub_index == count($menu)){?>
<!--                    </div>-->
<!--                </div>-->
<!--                --><?//}
//                }
//                else if($item['parent_id'] == $root_id
//                    && array_search($item['id'], $parents) === false
//                ){?>
<!--                    <li><a href="--><?//= $item['url'] ?><!--">--><?//= $item['name'] ?><!--</a></li>-->
<!--                --><?//} else if ($item['parent_id'] == $root_id && $sub_index == 0) {?>
<!--                    <li class="dropdown">-->
<!--                        <a class="dropdown-toggle" href="--><?//= $item['url'] ?><!--" data-toggle="collapse">-->
<!--                            <div class="link-name">--><?//= $item['name'] ?><!--</div>-->
<!--                            <div class="fa-angle-wrap">-->
<!--                                <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                        <ul class="nav collapse submenu">-->
<!--                            --><?// showFourthTemplate($menu, $item['id'], $parents); ?>
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?//}
//                }
//            }?>
<!--            --><?php //showFourthTemplate($menu, $root_id, $parents); ?>
<!--        </ul>-->
<!--    </nav>-->
<!---->
<?// else : ?>

<!--    <nav class="navbar third-template-navbar">-->
<!--        <ul class="nav third-template-nav">-->
<!--            <li><a href="javascript:void(0)">Главная</a></li>-->
<!--            <li class="dropdown">-->
<!--                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="collapse">-->
<!--                    <div class="link-name">Каталог</div>-->
<!--                    <div class="fa-angle-wrap">-->
<!--                        <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                    </div>-->
<!--                </a>-->
<!--                <ul class="nav collapse submenu">-->
<!--                    <li class="dropdown">-->
<!--                        <a class="dropdown-toggle" href="javascript:void(0);">-->
<!--                            <div class="link-name">Смартфоны</div>-->
<!--                            <div class="fa-angle-wrap">-->
<!--                                <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                        <ul class="nav collapse submenu">-->
<!--                            <li><a href="javascript:void(0)">Sumsung</a></li>-->
<!--                            <li><a href="javascript:void(0)">Sony</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li class="dropdown">-->
<!--                        <a class="dropdown-toggle" href="javascript:void(0);">-->
<!--                            <div class="link-name">Планшеты</div>-->
<!--                            <div class="fa-angle-wrap">-->
<!--                                <i class="fa fa-angle-down" aria-hidden="true"></i>-->
<!--                            </div>-->
<!--                        </a>-->
<!--                        <ul class="nav collapse submenu">-->
<!--                            <li><a href="javascript:void(0)">Apple</a></li>-->
<!--                            <li><a href="javascript:void(0)">Asus</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                </ul>-->
<!--            </li>-->
<!--            <li><a href="javascript:void(0)">О магазине</a></li>-->
<!--            <li><a href="javascript:void(0)">Контакты</a></li>-->
<!--        </ul>-->
<!--    </nav>-->

<?php //endif; ?>

<nav class="fourth-template-navbar navbar" role="navigation">

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
                <li><a href="javascript:void(0)" class="text-md-start"><i class="fa fa-home" aria-hidden="true"></i>ГЛАВНАЯ</a></li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-table" aria-hidden="true"></i>ПРОДУКЦИЯ</a>
                    <ul class="dropdown-menu">
                        <li><a href="javascript:void(0)">BEST DINNER</a></li>
                        <li>
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
</nav>

<style>
    .fourth-template-navbar button {
        border: 2px solid #fff!important;
    }

    .fourth-template-navbar .icon-bar {
        background-color: #fff;
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

    .fourth-template-navbar .navbar-nav .fa
    {
        margin-right: 3px;
    }

    .fourth-template-navbar .navbar-nav > li a{
        color: #fff !important;
        padding: 20px 25px !important;
    }

    .fourth-template-navbar .navbar-nav > li.open > a {
        color: #fff !important;
        background-color: #46505b !important;
    }

    .fourth-template-navbar .navbar-nav > li a:hover {
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

    .fourth-template-navbar li:hover > ul {
        display: block;
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
</style>

