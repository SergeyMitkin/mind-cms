<?php

namespace modules\menu\models;

class ShowTemplate
{
    public function showFirstTemplate($menu, $root_id, $parents) {
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
            } else if($item['parent_id'] == $root_id
                && array_search($item['id'], $parents) === false
                ){?>
                <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
            <?} else if ($item['parent_id'] == $root_id) {?>
                <li class="dropdown">
                    <a href="<?= $item['url'] ?>">
                        <div class="link-name"><?= $item['name'] ?></div>
                        <div class="fa-angle-wrap">
                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="nav submenu">
                        <? $this->showFirstTemplate($menu, $item['id'], $parents); ?>
                    </ul>
                </li>
            <?}
        }
    }

    public function showSecondTemplate($menu, $root_id, $parents) {
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
                    <a href="<?= $item['url'] ?>">
                        <div class="link-name"><?= $item['name'] ?></div>
                        <div class="triangle-right"></div>
                    </a>
                    <ul class="nav submenu">
                        <? $this->showSecondTemplate($menu, $item['id'], $parents); ?>
                    </ul>
                </li>
            <?}
        }
    }

    public function showThirdTemplate($menu, $root_id, $parents) {
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
            } else if($item['parent_id'] == $root_id
                && array_search($item['id'], $parents) === false
            ){?>
                <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
            <?} else if ($item['parent_id'] == $root_id && $sub_index == 0) {?>
                <li class="dropdown">
                    <a href="<?= $item['url'] ?>">
                        <div class="link-name"><?= $item['name'] ?></div>
                        <div class="fa-angle-wrap">
                            <i class="fa fa-angle-down" aria-hidden="true"></i>
                        </div>
                    </a>
                    <ul class="nav submenu">
                        <? $this->showThirdTemplate($menu, $item['id'], $parents); ?>
                    </ul>
                </li>
            <?}
        }
    }

    public function showFourthTemplate($menu, $root_id, $parents) {
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
            } else if($item['parent_id'] == $root_id
                    && array_search($item['id'], $parents) === false
                ){?>
                    <li><a href="<?= $item['url'] ?>"><?= $item['name'] ?></a></li>
            <?} else if ($item['parent_id'] == $root_id && $sub_index == 0) {?>
                <li class="dropdown">
                    <a href="<?= $item['url'] ?>"><?= $item['name'] ?></a>
                    <ul class="nav dropdown-menu">
                        <? $this->showFourthTemplate($menu, $item['id'], $parents); ?>
                    </ul>
                </li>
            <?}
        }
    }

}