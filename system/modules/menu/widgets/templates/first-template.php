
<?php
if (!empty($menu)) : ?>
<nav class="navbar first-template-navbar">
    <ul class="nav first-template-nav">
        <?php function showFirstTemplate($menu, $root_id, $parents) {
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
                            <div class="nav sub-item-wrap">
                                <li class="menu-subheader"><a href="javascript:void(0)"><?= $item['name'] ?></a></li>
                    <?} else if ($sub_index > 0){?>
                        <div class="nav sub-item-wrap">
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
            <?} else if ($item['parent_id'] == $root_id) {?>
                <li class="dropdown">
                    <a class="dropdown-toggle" href="<?= $item['url'] ?>" data-toggle="collapse">
                        <div class="link-name"><?= $item['name'] ?></div>
                        <div class="fa-angle-wrap">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="nav collapse submenu">
                        <? showFirstTemplate($menu, $item['id'], $parents); ?>
                    </ul>
                </li>
            <?}
            }
        }?>
        <?php showFirstTemplate($menu, $root_id, $parents); ?>
    </ul>
</nav>

<? else : ?>

<nav class="navbar first-template-navbar">
    <ul class="nav first-template-nav">
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

<style>

    .first-template-nav .nav.submenu,
    .first-template-nav .nav.sub-item-wrap
    {
        margin: 0 !important;
        padding: 0 !important;
    }

    .first-template-nav li
    {
        width: 250px;
        background: #181818;
        color: #fff;
        border-width: 2px 2px 0 2px !important;
        border-style: solid !important;
        border-color: #010101 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    @media (min-width: 600px) {
        .first-template-nav li:not(.sub-item-wrap>li):last-child {
            border-width: 2px 2px 2px 2px !important;
        }
    }

    .first-template-nav .sub-item-wrap:last-child>li:last-child {
        border-width: 2px 2px 2px 2px !important;
    }

    .first-template-nav li.menu-subheader {
        background: #535353;
    }
    .first-template-nav li.menu-subheader a:hover {
        cursor: default;
    }

    .first-template-nav a {
        border-radius: 0 !important;
        display: flex !important;
        justify-content: space-between !important;
    }
    .first-template-nav a:hover,
    .first-template-nav a:focus
    {
        background: #535353 !important;
        color: #fff !important;
    }

    .first-template-nav .submenu li {
        background: #fefefe;
        border-color: #dfdfdf !important;
    }

    .first-template-nav .submenu li.menu-subheader {
        background: #f1f1f1 !important;
    }

    .first-template-nav .submenu li a {
        color: #1d1d1d !important;
    }
    .first-template-nav .submenu li a:hover {
        background: #f1f1f1 !important;
    }

    .first-template-nav .fa-angle-wrap {
        width: 20px;
        position: relative;
        font-size: 15px;
    }

    .first-template-nav i.fa-angle-double-right {
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto 0;
    }

    .first-template-nav .submenu
    {
        position: absolute;
        top: -2px;
        right: -250px;
    }
    @media (max-width: 600px) {
        .first-template-nav .submenu {
            position: relative;
            top: 0;
            right: 2px;
        }
    }

    .first-template-nav li > ul
    {
        display: none;
    }

    .first-template-nav li:hover > ul
    {
        display: block;
    }

    .first-template-nav .sub-wrap {
        left: -250px;
    }

</style>