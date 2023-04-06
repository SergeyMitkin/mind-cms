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

    public function factory($id = false)
    {
        if ($id == false or !$this->getOne($id)) {
            $this->id = "";
            $this->name = "";
            $this->background_path = "";
        }
        return $this;
    }

    public function uploadBackground()
    {
        $file_name = mb_substr(basename($_FILES['background']['name']), 0, mb_stripos(basename($_FILES['background']['name']), '.'));
        $file_extension = mb_substr(basename($_FILES['background']['name']), mb_stripos(basename($_FILES['background']['name']), '.')+1);
        $file_type = mb_substr($_FILES['background']['type'], mb_stripos($_FILES['background']['type'], '/')+1);
        $file_tmp_name = $_FILES['background']['tmp_name'];
        $img_dir = '/assets/modules/map/img/';
        $array_ext_access = array('png', 'jpeg');  //Разрешённые расширения

        if (array_search($file_type, $array_ext_access) !== false) {
            // Кириллические символы заменяются латинскими
            if (preg_match("/[А-Яа-я]/", $file_name)) {
                $file_name = Tools::cyrToLat($file_name);
            }

            $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_dir . $file_name . '.' . $file_extension;
            // Если файл с таким именем существует, к имени добавляется timestamp
            if (!file_exists($file_path)) {
                move_uploaded_file($file_tmp_name, $file_path);
            } else {
                $file_name = $file_name . '-' . date('U');
                $file_path = $_SERVER['DOCUMENT_ROOT'] . $img_dir . $file_name . '.' . $file_extension;
                move_uploaded_file($file_tmp_name, $file_path);
            }

            return $file_name . '.' . $file_extension;
        } else {
            return '';
        }
    }
}