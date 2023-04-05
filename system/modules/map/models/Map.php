<?php

namespace modules\map\models;

use core\Model;
use core\Tools;

/**
 * Class Page
 * @property integer id -
 * @property string name -
 * @property string background_path -
 */

class Map extends Model
{
    public $table = 'maps';
    private $img_dir = '/assets/modules/map/img/';

    public function factory($id = false)
    {
        if ($id == false or !$this->getOne($id)) {
            $this->id = "";
            $this->name = "";
            $this->background_path = "";
        }
        return $this;
    }

    public function  beforeInsert()
    {
        if (isset($_FILES['background']) && $_FILES['background']['error'] === 0) {
            $file_name = $_FILES['background']['name'];
            $file_type = $_FILES['background']['type'];
            $file_tmp_name = $_FILES['background']['tmp_name'];

            // Валидация
            $split_filetype = explode('/', $file_type);
            $type = end($split_filetype);
            $array_ext_access = array('png', 'img');  //Разрешённые расширения

            if (array_search($type, $array_ext_access) !== false) {
                // Проверка background_path на уникальность в дирректории

                // Кириллические символы заменяются латинскими
                if( preg_match("/[А-Яа-я]/", $file_name) ) {
                    $split_filename = explode('.', $file_name);
                    $file_name = Tools::cyrToLat(reset($split_filename)) . '.' . $type;
                }
                $file_path = $_SERVER['DOCUMENT_ROOT'] . $this->img_dir . $file_name;

                if (!file_exists($file_path)) {
                    move_uploaded_file($file_tmp_name, $file_path);
                } else {
                    // --- ОТЛАДКА НАЧАЛО
                    echo '<pre>';
                    var_dump('есть');
                    echo'</pre>';
                    die;
                    // --- Отладка конец
                }
            }
        }

        // --- ОТЛАДКА НАЧАЛО
//        echo '<pre>';
//        var_dump($_FILES);
//        var_dump($file_name);
//        echo'</pre>';
//        die;
        // --- Отладка конец

    }

//    public function beforeSave()
//    {
//        // Проверяем background_path на уникальность в дирректории
//        $file_name = $_FILES['background']['name'];
//
//
//
//        // --- ОТЛАДКА НАЧАЛО
//        echo '<pre>';
//        var_dump('before');
//        echo'</pre>';
//        die;
//        // --- Отладка конец
//    }


}