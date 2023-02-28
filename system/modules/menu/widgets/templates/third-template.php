
<?php
if (!empty($menu)) : ?>
    <nav class="navbar third-template-navbar">
        <ul class="nav third-template-nav">
            <?php function showThirdTemplate($menu, $root_id, $parents) {
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
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav collapse submenu">
                            <? showThirdTemplate($menu, $item['id'], $parents); ?>
                        </ul>
                    </li>
                <?}
                }
            }?>
            <?php showThirdTemplate($menu, $root_id, $parents); ?>
        </ul>
    </nav>

<? else : ?>

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

<?php endif; ?>

