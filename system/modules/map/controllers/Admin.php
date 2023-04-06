<?php

namespace modules\map\controllers;

use core\Controller;
use core\Html;
use core\Tools;
use modules\map\models\Map;

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

            if (isset($_FILES['background']) && $_FILES['background']['error'] === 0) {
                $file_name = mb_substr($_FILES['background']['name'], 0, mb_stripos($_FILES['background']['name'], '.'));
                $file_type = mb_substr($_FILES['background']['type'], mb_stripos($_FILES['background']['type'], '/')+1);
                $file_tmp_name = $_FILES['background']['tmp_name'];
                $img_dir = '/assets/modules/map/img/';
                $array_ext_access = array('png', 'jpeg');  //Разрешённые расширения

                if (array_search($file_type, $array_ext_access) !== false) {
                    // Проверка background_path на уникальность в дирректории

                    // Кириллические символы заменяются латинскими
                    if( preg_match("/[А-Яа-я]/", $file_name) ) {
                        $file_name = Tools::cyrToLat($file_name);
                    }
                    $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_dir . $file_name . '.' . $file_type;
                    if (!file_exists($file_path)) {
                        move_uploaded_file($file_tmp_name, $file_path);
                    } else {
                        $file_name = $file_name . '-' . date('U');
                        $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_dir . $file_name. '.' . $file_type;
                        move_uploaded_file($file_tmp_name, $file_path);
                    }

                    $data['name'] = $_POST['name'];
                    $data['background_path'] = $file_name . '.' . $file_type;

                    Map::instance()->save($data);
                }
            }

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