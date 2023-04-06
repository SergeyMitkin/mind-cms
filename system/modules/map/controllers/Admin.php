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
                $data['name'] = $_POST['name'];
                $data['background_path'] = Map::instance()->uploadBackground();
                Map::instance()->save($data);
            }
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
}