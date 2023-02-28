
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

    .third-template-nav > li {
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
    }
    .third-template-nav li a:hover {
        background: #3c98d4 !important;
        color: #f7f7f7 !important;
    }

    .third-template-nav > .dropdown > .submenu  li {
        background: #424952;
        border-color: #383e47 !important;
    }
    .third-template-nav .submenu li a:hover {
        background: #45545f !important;
    }

    .third-template-nav li > ul {
        display: none;
    }

    .third-template-nav li:hover > ul {
        display: block;
    }
</style>

