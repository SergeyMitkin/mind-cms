
<?php
if (!empty($menu)) : ?>
    <nav class="navbar second-template-navbar">
        <ul class="nav second-template-nav">
            <?php function showSecondTemplate($menu, $root_id, $parents) {

            $children_count = 0;
            foreach ($menu as $menu_item) {
                if ($menu_item['parent_id'] == $root_id){
                    $children_count++;
                }
            }

            $sub_index = 0;
            foreach ($menu as $item) {
                if ($item['parent_id'] == $root_id
                    && $item['is_subheader']
                ){
                    if ($sub_index == 0) {?>
                        <li class="sub-wrap">
                    <?} else {?>
                        </ul> <!-- закрывается предыдущий .sub-item -->
                    <?}?>

                    <? $sub_index++; ?>
                    <ul class="nav sub-item">
                        <li class="menu-subheader"><a href="javascript:void(0)"><?= $item['name'] ?></a></li>

                    <?} else if($item['parent_id'] == $root_id
                        && array_search($item['id'], $parents) === false
                    ){?>

                        <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
                        <? if ($sub_index !== 0){$sub_index++;} ?>

                        <? if ($sub_index > 2 &&
                                $sub_index == $children_count-1
                        ){?>
                                </ul> <!-- закрываются .sub-wrap и .sub-item -->
                            </li>
                        <?} else if ($sub_index == $children_count) {?>
                                </ul> <!-- закрываются .sub-wrap и .sub-item -->
                            </li>
                        <?}?>

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
            <li><a href="javascript:void(0)">Menu Item A</a></li>
            <li class="dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);" data-toggle="collapse">
                    <div class="link-name">Menu Item B</div>
                    <div class="triangle"></div>
                </a>
                <ul class="nav collapse submenu">
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
    </nav>

<?php endif; ?>
