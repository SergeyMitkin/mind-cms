<?php

namespace modules\map\controllers;

use core\Controller;
use core\Html;
use modules\menu\models\Menu;

class Admin extends Controller
{
    public $menu = 'topmenu.php';

	function __construct()
	{
		parent::__construct();
        $this->html = Html::instance();
        $this->html->setCss('/assets/modules/map/css/topmenu.css');
        $this->html->setJs('/assets/modules/map/js/topmenu.js');
	}

	public function actionIndex()
	{
        $this->html->setCss('/assets/modules/map/builder/EMBMap.css');
        $this->html->setJs('/assets/modules/map/builder/EMBMap.js');
        $this->html->content = $this->render(
            "MapList.php", [
                'topmenu'   => $this->render($this->menu, [
                    'action' => 'index'
                ]),
            ]
        );
        $this->html->renderTemplate("@admin")->show();
	}

    function actionAdd($id = false)
    {
        if (!empty($_POST)) {
            header('Location:/map/admin');
            // К url добавляется слэш
//            if (isset($_POST['url']) && substr($_POST['url'], 0, 1)!="/") {
//                $_POST['url'] = "/".$_POST['url'];
//            }
//
//            Menu::instance()->saveMenu('add', $_POST);
//
//            // Направляем на страницу корневой категории
//            if (isset($_POST['parent_id']) && isset($_POST['menu_id'])){
//                $root_id = Menu::getParentIdByMenuId($_POST['menu_id']);
//                header('Location:/menu/admin/listmenu/' . $root_id);
//            } else {
//                header('Location:/menu/admin');
//            }
        }
        else {
            $this->html->setJs('/assets/modules/map/js/addMap.js');
            $this->html->content = $this->render(
                'addMap.php', [
                    'topmenu'   => $this->render($this->menu, [
                        'action' => 'addMap'
                    ]),
                ]
            );
        }

        $this->html->renderTemplate("@admin")->show();
    }
}