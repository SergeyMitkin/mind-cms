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
}