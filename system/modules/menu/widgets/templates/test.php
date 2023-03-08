public function showFirstTemplate($menu, $root_id, $parents, $html = '') {
        $sub_index = 0;
        foreach ($menu as $item) {
            if ($item['parent_id'] == $root_id
                && array_search($item['id'], $parents) === false
                && $item['is_subheader']){
                if($sub_index !== 0) {
                    $html .= '</div>';
                }?>
                <? if ($sub_index == 0) {

                    $html .= '<div class="sub-wrap">
                        <div class="nav sub-item">
                            <li class="menu-subheader"><a href="javascript:void(0)">' . $item['name'] . '</a></li>';
                } else if ($sub_index > 0){
                    $html .= '<div class="nav sub-item">
                        <li class="menu-subheader"><a href="javascript:void(0)">' . $item['name'] . '</a></li>';
                }
                $sub_index++;
                if ($sub_index > 0 && $sub_index == count($menu)){
                        $html .= '</div>
                    </div>';
                }
            } else if($item['parent_id'] == $root_id
                && array_search($item['id'], $parents) === false
                ){?>

                <? if($item['is_noindex'] == 1) {
                    $html .= '<noindex>
                        <li><a href="' . $item['url'] .'"' . ($item['is_nofollow'] == 1) ? ' rel="nofollow"' : ''; $html .= '>' . $item['name'] . '</a></li>
                    </noindex>';
                } else {?>
                    <li><a href="<?= $item['url'] ?>"<?=($item['is_nofollow'] == 1)?' rel="nofollow"':''?>><?= $item['name'] ?></a></li>
                <?}?>

            <?} else if ($item['parent_id'] == $root_id) {?>
                <? if($item['is_noindex'] == 1) {?>
                    <noindex>
                        <li class="dropdown">
                            <a href="<?= $item['url'] ?>" <?=($item['is_nofollow'] == 1)?' rel="nofollow"':''?>>
                                <div class="link-name"><?= $item['name'] ?></div>
                                <div class="fa-angle-wrap">
                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                </div>
                            </a>
                            <ul class="nav submenu">
                                <? $this->showFirstTemplate($menu, $item['id'], $parents); ?>
                            </ul>
                        </li>
                    </noindex>
                <?} else {?>
                    <li class="dropdown">
                        <a href="<?= $item['url'] ?>" <?=($item['is_nofollow'] == 1)?' rel="nofollow"':''?>>
                            <div class="link-name"><?= $item['name'] ?></div>
                            <div class="fa-angle-wrap">
                                <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="nav submenu">
                            <? $this->showFirstTemplate($menu, $item['id'], $parents, $html); ?>
                        </ul>
                    </li>
                <?}?>
            <?}
        }

        return $html;
    }
