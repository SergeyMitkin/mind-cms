<?php

namespace modules\map\controllers;

use core\Controller;
use core\Html;
use modules\map\models\Map;

class Admin extends Controller
{
    public $menu = 'topmenu.php';
    public $background_dir = '/assets/modules/map/img/';

	function __construct()
	{
		parent::__construct();
        $this->html = Html::instance();
        $this->html->setCss('/assets/modules/map/css/topmenu.css');
        $this->html->setJs('/assets/modules/map/js/topmenu.js');
	}

	public function actionIndex()
	{
        $this->html->content = $this->render(
            "MapList.php", [
                'topmenu'   => $this->render($this->menu, [
                    'action' => 'index'
                ]),
                'mapList' => Map::instance()->getAll()
            ]
        );
        $this->html->renderTemplate("@admin")->show();
	}

    function actionAdd()
    {
        if (!empty($_POST)) {
            $data['name'] = $_POST['name'];
            if (isset($_FILES['background']) && $_FILES['background']['error'] === 0) {
                $data['background_path'] = Map::instance()->uploadBackground($this->background_dir);
            }
            $data['canvas_json'] = $_POST['canvas_json'];
            Map::instance()->save($data);

            header('Location:/map/admin');
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

    public function actionEdit($id)
    {
        $mapInfo = Map::instance()->getOne($id);

        $this->html->setCss('/assets/modules/map/builder/EMBMap.css');
        $this->html->setJs('/assets/modules/map/builder/EMBMap.js');
        $this->html->setCss('/assets/modules/map/css/form.css');

        if (!empty($_POST)) {
            $data['id'] = $id;
            $data['name'] = $_POST['name'];
            $data['canvas_json'] = $_POST['canvas_json'];
            if (isset($_FILES['background']) && $_FILES['background']['error'] === 0) {
                $data['background_path'] = Map::instance()->uploadBackground($this->background_dir);
            }
            Map::instance()->update($data);

            header('Location:/map/admin');
        }

        $this->html->content = $this->render(
        'addMap.php', [
                'topmenu'   => $this->render($this->menu, [
                    'action' => 'addMap',
                ]),
                'mapInfo' => $mapInfo,
                'img_dir' => $this->background_dir
            ]
        );

        $this->html->renderTemplate("@admin")->show();
    }

    public function actionView($id) {

    }
}