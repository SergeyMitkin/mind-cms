<?php

use core\Model;

/**
 * Class Page
 * @property integer id -
 * @property string name -
 * @property string background_path -
 */

class Map extends Model
{
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

    public function beforeSave()
    {
        // Проверяем background_path на уникальность в дирректории

    }


}