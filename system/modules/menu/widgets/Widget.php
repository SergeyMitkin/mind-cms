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

    function showMenu($id=2, $template='test') {
        $result = parent::getChildMenuInfo($id, true);
        Html::instance()->setJs('/assets/modules/menu/js/' . $template . '.js');
        $result = $result ? Html::instance()->render(__DIR__ . '/templates/' . $template . '.php', ['menu' => $result]) : FALSE;

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
