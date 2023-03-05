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

    function showMenu($id = -1, $template=false) {
        // Если не создаётся новое меню
        if ($id != -1) {
            $menu_stm = "SELECT * FROM menu WHERE visible = 1 AND type = 'child' AND menu_id = $id";
            $menu_items = parent::instance()->pdo->query($menu_stm)->fetchAll();

            // Id root и имя шаблона
            $root_stm = "SELECT menu.id, templates.`name` FROM menu
                        LEFT JOIN templates ON menu.template_id = templates.id
                        WHERE type = 'root' AND menu_id = $id";
            $root_id = parent::instance()->pdo->query($root_stm)->fetch()['id'];

            // Если меню вывоодится не в форме создания основного меню.
            if (!$template) {
                $template = parent::instance()->pdo->query($root_stm)->fetch()['name'];
            } else {
                $template = $template;
            }
        } else {
            $menu_items = [];
            $root_id = 0;
        }

        // Id родительских элментов
        $parents = [];
        foreach ($menu_items as $item) {
            if ($item['type'] == 'child' && !in_array($item['parent_id'], $parents)){
                $parents[] = $item['parent_id'];
            }
        }

        Html::instance()->setCss('/assets/modules/menu/css/' . $template . '.css');
        Html::instance()->setJs('/assets/modules/menu/js/' . $template . '.js');
        $result = Html::instance()->render(__DIR__ . '/templates/' . $template . '.php', ['menu' => $menu_items, 'root_id' => $root_id, 'parents' => $parents]);

        return $result;

        /*if (empty($template)) {
            $template = "menu";
        }
        $result = parent::getChildMenuInfo($id, true);
        $result = $result ? $this->app->html->render(__DIR__ . '/templates/' . $template . '.php', ['menu' => $result]) : FALSE;

        return $result;*/

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
