<?php

namespace modules\menu\widgets;

use core\Html;
use modules\menu\models\Menu;

class Widget extends Menu {

    public static $instance;

    public static function instance() {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function showMenu($id=-1, $root_id=0,  $children_items=[], $parents=[], $template=false) {
        // При редактировании и выводе на фронтенде
        if ($id != -1) {
            // При выводе на фронтенде
            if (empty($children_items)) {
                $children_items = Menu::getChildrenItems($id);
            }

            if ($root_id === 0) {
                $root_item = Menu::getRootItem($id);
                $root_id = $root_item['id'];
                // Если меню вывоодится не в форме создания основного меню
                if (!$template) {
                    $template = $root_item['template_name'];;
                }
            }
        } else {
            $children_items = [];
            $root_id = 0;
        }

        // Id родительских элментов
        if (empty($parents)) {
            foreach ($children_items as $item) {
                if ($item['type'] == 'child' && !in_array($item['parent_id'], $parents)){
                    $parents[] = $item['parent_id'];
                }
            }
        }

        Html::instance()->setJs('/assets/modules/menu/js/' . $template . '.js');
        $result = Html::instance()->render(__DIR__ . '/templates/' . $template . '.php', ['menu' => $children_items, 'root_id' => $root_id, 'parents' => $parents]);

        return $result;

//        if ($id > 0) {
//            $model = new Menu();
//            if ($menu = $model->getOne($id)) {
//                if ($menu->id > 0) {
//                    $left_key = $menu->left_key;
//                    $right_key = $menu->right_key;
//                    $data = $model->clear()->where('left_key', '>', $left_key)->where('right_key', '<', $right_key)->where('level','=',1)->where('visible', '=', 1)->orderBy('position ASC,id ASC')->getAll();
//                    echo Html::instance()->render(__DIR__ . "/templates/" . $template, $data);
//                }
//            }
//        }

    }

}
