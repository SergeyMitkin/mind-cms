<style>
    .second-template-nav .nav.submenu
    {
        margin: 0 !important;
        padding: 0 !important;
    }

    .second-template-nav li
    {
        width: 250px;
        background: #303030;
        border-width: 2px 2px 2px 2px !important;
        border-style: solid !important;
        border-color: #232323 !important;
        border-top-color: #4b4b4b !important;
        margin: 0 !important;
        padding: 0 !important;
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
        display: flex;
        justify-content: space-between;
    }
    .second-template-nav li a:hover {
        background: #4b4b4b !important;
        color: #f7f7f7 !important;
    }

    .second-template-nav .triangle {
        position: relative;
        width: 20px;
        height: 100%;
    }
    .triangle::after {
        content: '';
        position: absolute;
        border: 5px solid transparent;
        border-left: 5px solid #f7f7f7;
        margin: 5px 0;
    }

    .second-template-nav .submenu
    {
        position: absolute;
        top: -2px;
        right: -250px;
    }

    .second-template-nav li > ul
    {
        display: none;
    }

    .second-template-nav li:hover > ul
    {
        display: block;
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
        width: 20px;
        height: 10px;
        margin: 5px 0;
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

</style>

<?php
if (!empty($menu)) : ?>
    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <?php function showSecondTemplate($menu, $root_id, $parents) {
            $sub_index = 0;
            foreach ($menu as $item) {
                if ($item['parent_id'] == $root_id
                && array_search($item['id'], $parents) === false
                && $item['is_subheader']){
                    if($sub_index !== 0) {?>
                        </div>
                    <?}?>
                    <? if ($sub_index == 0) {?>
                    <div class="sub-wrap">
                        <div class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)"><?= $item['name'] ?></a></li>
                            <?} else if ($sub_index > 0){?>
                            <div class="nav sub-item">
                                <li class="menu-subheader"><a href="javascript:void(0)"><?= $item['name'] ?></a></li>
                                <?}?>
                                <? $sub_index++;
                                if ($sub_index > 0 && $sub_index == count($menu)){?>
                            </div>
                        </div>
                    <?}
                    }
                    else if($item['parent_id'] == $root_id
                        && array_search($item['id'], $parents) === false
                    ){?>
                        <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
                    <?} else if ($item['parent_id'] == $root_id && $sub_index == 0) {?>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="<?= $item['url'] ?>" data-toggle="collapse">
                                <div class="link-name"><?= $item['name'] ?></div>
                                <div class="triangle"></div>
                            </a>
                            <ul class="nav collapse submenu">
                                <? showSecondTemplate($menu, $item['id'], $parents); ?>
                            </ul>
                        </li>
                    <?}
                    }
                }?>
            <?php showSecondTemplate($menu, $root_id, $parents); ?>
        </ul>
    </nav>

<? else : ?>

    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <li><a href="javascript:void(0)">Link 1</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="collapse">
                    <div class="link-name">Link 2</div>
                    <div class="fa-angle-wrap">
                        <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </div>
                </a>
                <ul class="nav collapse submenu">
                    <li><a href="javascript:void(0)">Link 2.1</a></li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="javascript:void(0);">
                            <div class="link-name">Link 2.2</div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav collapse submenu">
                            <li><a href="javascript:void(0)">Link 3.1</a></li>
                            <li><a href="javascript:void(0)">Link 3.2</a></li>
                            <li><a href="javascript:void(0)">Link 3.3</a></li>
                        </ul>
                    </li>
                    <li><a href="javascript:void(0)">Link 2.3</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0)">Link 3</a></li>
        </ul>
    </nav>

<?php endif; ?>
