
<?php
//if (!empty($menu)) : ?>
<!--    <nav class="navbar third-template-navbar">-->
<!--        <ul class="nav third-template-nav">-->
<!--            --><?php //function showThirdTemplate($menu, $root_id, $parents) {
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
<!--                            <div class="triangle"></div>-->
<!--                        </a>-->
<!--                        <ul class="nav collapse submenu">-->
<!--                            --><?// showThirdTemplate($menu, $item['id'], $parents); ?>
<!--                        </ul>-->
<!--                    </li>-->
<!--                --><?//}
//                }
//            }?>
<!--            --><?php //showThirdTemplate($menu, $root_id, $parents); ?>
<!--        </ul>-->
<!--    </nav>-->
<!---->
<?// else : ?>

    <nav class="navbar third-template-navbar">
        <ul class="nav third-template-nav">
            <li><a href="javascript:void(0)">Главная</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="collapse">
                    <div class="link-name">Каталог</div>
                    <div class="fa-angle-wrap">
                        <i class="fa fa-angle-down" aria-hidden="true"></i>
                    </div>
                </a>
                <ul class="nav collapse submenu">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <div class="link-name">Смартфоны</div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav collapse submenu">
                            <li><a href="javascript:void(0)">Sumsung</a></li>
                            <li><a href="javascript:void(0)">Sony</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <div class="link-name">Планшеты</div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav collapse submenu">
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

<?php //endif; ?>


<style>
    .third-template-nav .nav.submenu {
        margin: 0 !important;
        padding: 0 !important;
    }

    .third-template-nav li {
        width: 250px;
        background: #48a7e2;
        border-width: 2px 2px 0 2px !important;
        border-style: solid !important;
        border-color: #438bbc !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .third-template-nav li:not(.sub-item-wrap>li):last-child {
        border-width: 2px 2px 2px 2px !important;
    }

    .third-template-nav .sub-item-wrap:last-child>li:last-child {
        border-width: 2px 2px 2px 2px !important;
    }


    .third-template-nav .sub-wrap li {
        background: unset;
    }

    .third-template-nav li.menu-subheader {
        background: #fe8303;
    }
    .third-template-nav li.menu-subheader a:hover {
        cursor: default;
        background: #fe8303 !important;
    }

    .third-template-nav li a {
        color: #f7f7f7;
        font-weight: 700;
        border-radius: 0 !important;
        display: flex !important;
        justify-content: space-between;
    }
    .third-template-nav li a:hover {
        background: #4b4b4b !important;
        color: #f7f7f7 !important;
    }

    .third-template-nav .triangle {
        position: relative;
        width: 20px;
        height: 100%;
    }

    .third-template-nav .submenu
    {
        position: absolute;
        top: -2px;
        right: -250px;
    }

    .third-template-nav li > ul
    {
        display: none;
    }

    .third-template-nav li:hover > ul
    {
        display: block;
    }

    .third-template-nav .sub-item {
        margin: 10px !important;
    }

    .third-template-nav .sub-item li {
        border: none !important;
        width: 200px;
    }

    .third-template-nav .sub-item li:not(.menu-subheader) a {
        font-weight: 100;
        justify-content: unset;
    }
    .third-template-nav .sub-item li:not(.menu-subheader) a:hover {
        color: #4b4b4b !important;
    }
    .third-template-nav .sub-item li:not(.menu-subheader) a:before {
        content: "";
        background-image: url("/assets/modules/menu/img/dotted-arrow.png");
        background-repeat: no-repeat;
        background-size: contain;
        width: 20px !important;
        height: 10px !important;
        display: inline-block;
        margin: 5px 0 0 -5px;
    }

    .third-template-nav .sub-wrap {
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
</style>

