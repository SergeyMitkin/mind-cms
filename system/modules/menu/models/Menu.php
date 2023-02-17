<?php

namespace modules\menu\models;

use core\App;
use core\Model;
use core\Tools;
use modules\feedback\models\mFeedbackFields;
use modules\user\models\USER;


/**
 * Class Page
 * @property string id -
 * @property string name -
 * @property string visible -
 * @property string url -
 * @property string create_at -
 * @property string update_at -
 * @property string user_id -
 * @property string level -
 * @property string left_key -
 * @property string right_key -
 * @property string domain -
 * @property string is_nofollow
 * @property string is_noindex
 * @property string position
 * @property integer parent_id
 * @property string type
 * @property integer menu_id
 * @property string extData
 */
class Menu extends Model
{
    public $table = 'menu';
    public static $currentTable = 'menu';

	public function factory($id = false)
	{
		if ($id == false or !$this->getOne($id)) {
			$this->id = "";
			$this->name = "";
			$this->visible = 1;
			$this->url = "";
			//$this->create_at = "";
			$this->update_at = "NULL";
			$this->user_id = "";
			$this->level = 0;
			$this->left_key = "";
			$this->right_key = "";
			$this->domain = "";
			$this->is_nofollow = "0";
			$this->is_noindex = "0";
			$this->position = 1;
            $this->type = "";
            $this->parent_id = 0;
            $this->menu_id = 0;
			$this->extData = null;
        }
        return $this;
    }

    /**
     * Прежде чем вставлять  сделаем урл, и проставим ключи границ
     * @return bool
     */
    public function beforeInsert()
    {
        //Вычисляем границы если они не переданы
        if (empty($_POST['left_key'])) { //если границы переданы
            $time = new self();
            $time->clear()->select('max(right_key) as m')->getOne();
            $this->left_key  = $time->m + 1; //взводим левую границу
            $this->right_key = $time->m + 2; //взводим правую границу
            $this->level     = 0;
//            $time->clear()->select('max(position) as p')->where(['level' => 0])->getOne();
//            $this->position = $time->p + 1;
        }

        //время создания
        $this->create_at = date("Y-m-d H:i:s", time());

        //взводим создателя записи
        if (!empty(USER::current()->id)) {
            $this->user_id = USER::current()->id;
        } else {
            $this->user_id = 0;
        }

        //  $this->clear()->select('max(position) as m')->where()->getOne();
        //возвращаем тру есил все ок
        return true;

    }

    /**
     * Прежде чем обновлять запись проверим что url есть и проерим его
     * @return bool
     */
    public function beforeUpdate()
    {
        $this->update_at = date("Y-m-d H:i:s", time());
        return true;
    }

    /**
     * Прежде чем удадять, удалим все вложенности
     * @return bool
     */
    public function beforeDelete()
    {
        /*
         * Сносим дочерние элементы
         */
        $this->id = false; //чтобы включить массоеое удаление
        //$this->where('left_key', ">=", $this->left_key)->where('right_key', '<=', $this->right_key);
        return true;
    }

//    public function GetForList()
//    {
//        $new_array = "";
//        return $this->clear()->select('id,name, url ,left_key,right_key, level, visible, position')->orderBy('position ASC, left_key ASC')->getAll();
//    }

    public static function getMaxPosition($parent_id) {
        $stm = "SELECT MAX(`position`) + 1 as 'position'
                FROM " . self::$currentTable . " "
            . "WHERE `parent_id` = '" . $parent_id . "'";

        $sql_result = self::instance()->pdo->query($stm)->fetchColumn();
        $sql_result = !empty($sql_result) ? $sql_result : 1;

        return $sql_result;
    }

    public function saveMenu($action, $data){

        $data['noindex'] = isset($data['noindex']) ? $data['noindex'] : '0';
        $data['nofollow'] = isset($data['nofollow']) ? $data['nofollow'] : '0';

        if ($action == 'add') {

            $data['menu_id'] = !empty($data['menu_id']) || (isset($data['menu_id']) && $data['menu_id'] == '0') ? $data['menu_id'] : self::getMaxMenu();
            $parent_id = isset($data['parent_id']) ? $data['parent_id'] : '0';
            $data['position'] = self::getMaxPosition($parent_id);

            self::instance()->factory()->fill($data)->save();
        } elseif ($action == 'edit') {
            $sql_result = App::instance()->db->update(self::$currentTable, $data)->where(self::$currentTable . '.id', $data['id'])->execute();
        }
    }

    public static function getMaxMenu() {
        $stm = "SELECT MAX(`menu_id`) + 1  as 'max_menu'
                FROM " . self::$currentTable;
        $sql_result = self::instance()->pdo->query($stm)->fetchColumn();
        if (empty($sql_result)) {
            $sql_result = 1;
        }
        return $sql_result;
    }

    public static function getMenuId($catid) {
        $stm = "SELECT `menu_id`
                FROM " . self::$currentTable . " "
            . "WHERE `id` = '" . $catid . "'";
        $sql_result = self::instance()->pdo->query($stm)->fetchColumn();
        return $sql_result;
    }

    public static function UpdateSort($data) {
        $positions = $data['positions'];
        $i = 1;
        foreach ($positions as $value) {
            self::instance()
                ->where('id', '=', $value)
                ->update(['position' => $i, 'parent_id' => $data['parentID']]);
            $i++;
        }
    }

    public static function getRootMenu() {
        $sql_result = self::instance()
            ->where('type', '=', 'root')
            ->getAll();

        $new_array = [];
        foreach ($sql_result as $value) {
            $value->count = self::getCountMenu($value->id);;
            $new_array[] = $value;
        }

        return $new_array;
    }

    public static function getCountMenu($id) {
        $stm = "SELECT count(`id`) as count FROM " . self::$currentTable . "
               WHERE  `parent_id` ='" . $id . "'";
        $sql_result = self::instance()->pdo->query($stm)->fetchAll();
        return $sql_result[0]['count'];
    }

    public static function getChildMenuInfo($id = FALSE, $widget = FALSE) {
        if ($widget == FALSE) {
            $sql_result = self::instance()
                ->where([self::$currentTable . '.type' => 'children', self::$currentTable . '.parent_id' => $id])
                ->orderBy('position')->getAll();
        } else {
            $sql_result = App::instance()->db->from(self::$currentTable)
                ->where([self::$currentTable . '.deleted' => 0, self::$currentTable . '.visible' => 1, self::$currentTable . '.menu_id' => $id, self::$currentTable . '.type' => 'children'])
                ->orderBy('position')->fetchAll();
        }
        return $sql_result;
    }

    public static function tree($array, $parentId) {
        if (empty($array)) {
            return;
        }
        foreach ($array as $node) {
            $treeData[$node->parent_id][] = $node;
        }

        function buildTree($data, $pid = 0, $first = true) {

            $html = '';
            if (isset($data[$pid])) {
                foreach ($data[$pid] as $item) {
                    $link = " <a style='font-size: 10px;' href='" . $item->url . "'>[" . $item->url . "]</a>";
                    $html .= "<li class ='list-group-item' data-id='" . $item->id . "'>" . $item->name . $link . showButtons($item) . buildTree($data, $item->id) . "</li>";
                }
            }
            if ($first) {
                $html = '<ol>' . $html . '</ol>';
            }
            return $html;
        }

        function showButtons($item) {

            $eye = ($item->visible == 1) ? 'glyphicon-eye-open' : 'glyphicon-eye-close';

            $out = '<span class="actions">
            <a href="javascript:void(0);" class="change_status" data-id="' . $item->id . '" data-current="' . $item->visible . '">
            <i class="glyphicon ' . $eye . '"></i></a>
            <a href="/menu/admin/add/' . $item->id . '/' . $item->parent_id . '" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i> Добавить</a>
            <a href="/menu/admin/edit/' . $item->id . '" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Редактировать</a>
            <a href="/menu/admin/delete/' . $item->id . '" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Удалить</a></span>';
            return $out;
        }

        return buildTree($treeData, $parentId, FALSE);
    }

    public function moveNode($pk, $pid)
    {
        $primary_row = $this->clear()->where(['id' => $pk])->getOne();
        $left_id       = $primary_row->left_key;
        $right_id      = $primary_row->right_key;
        $level         = $primary_row->level;
        $secondary_row = $this->clear()->where(['id' => $pid])->getOne();
        $left_idp  = $secondary_row->left_key;
        $right_idp = $secondary_row->right_key;
        $levelp    = $secondary_row->level;
        if ($pk == $pid || $left_id == $left_idp || ($left_idp >= $left_id && $left_idp <= $right_id) || ($level == $levelp + 1 && $left_id > $left_idp && $right_id < $right_idp)) {
            return false;
        }
        $sql = 'UPDATE ' . $this->table . ' SET ';
        if ($left_idp < $left_id && $right_idp > $right_id && $levelp < $level - 1) {
            $sql .= 'level = CASE WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'right_key = CASE WHEN right_key BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN right_key-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN right_key+' . ((($right_idp - $right_id - $level + $levelp) / 2) * 2 + $level - $levelp - 1) . ' ELSE right_key END, ';
            $sql .= 'left_key = CASE WHEN left_key BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN left_key-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN left_key+' . ((($right_idp - $right_id - $level + $levelp) / 2) * 2 + $level - $levelp - 1) . ' ELSE left_key END ';
            $sql .= 'WHERE left_key BETWEEN ' . ($left_idp + 1) . ' AND ' . ($right_idp - 1);
        } elseif ($left_idp < $left_id) {
            $sql .= 'level = CASE WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'left_key = CASE WHEN left_key BETWEEN ' . $right_idp . ' AND ' . ($left_id - 1) . ' THEN left_key+' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN left_key-' . ($left_id - $right_idp) . ' ELSE left_key END, ';
            $sql .= 'right_key = CASE WHEN right_key BETWEEN ' . $right_idp . ' AND ' . $left_id . ' THEN right_key+' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN right_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN right_key-' . ($left_id - $right_idp) . ' ELSE right_key END ';
            $sql .= 'WHERE (left_key BETWEEN ' . $left_idp . ' AND ' . $right_id . ' ';
            $sql .= 'OR right_key BETWEEN ' . $left_idp . ' AND ' . $right_id . ')';
        } else {
            $sql .= 'level = CASE WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN level' . sprintf('%+d', -($level - 1) + $levelp) . ' ELSE level END, ';
            $sql .= 'left_key = CASE WHEN left_key BETWEEN ' . $right_id . ' AND ' . $right_idp . ' THEN left_key-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN left_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN left_key+' . ($right_idp - 1 - $right_id) . ' ELSE left_key END, ';
            $sql .= 'right_key = CASE WHEN right_key BETWEEN ' . ($right_id + 1) . ' AND ' . ($right_idp - 1) . ' THEN right_key-' . ($right_id - $left_id + 1) . ' ';
            $sql .= 'WHEN right_key BETWEEN ' . $left_id . ' AND ' . $right_id . ' THEN right_key+' . ($right_idp - 1 - $right_id) . ' ELSE right_key END ';
            $sql .= 'WHERE (left_key BETWEEN ' . $left_id . ' AND ' . $right_idp . ' ';
            $sql .= 'OR right_key BETWEEN ' . $left_id . ' AND ' . $right_idp . ')';
        }
        $this->query($sql);
        return true;
    }

    public function deleteNode($pk)
    {
        //получаем данные по первой строке..
        $primary_row = $this->clear()->where(['id' => $pk])->getOne();

        $left_id  = $primary_row->left_key;
        $right_id = $primary_row->right_key;

        $this->clear()->between('left_key', $left_id, $right_id)->delete();
        $delta_id = (($right_id - $left_id) + 1);
        $sql      = 'UPDATE ' . $this->table . ' SET ';
        $sql      .=  'left_key = CASE WHEN left_key > ' . $left_id . ' THEN left_key - ' . $delta_id . ' ELSE left_key END, ';
        $sql      .= 'right_key = CASE WHEN right_key > ' . $left_id . ' THEN right_key - ' . $delta_id . ' ELSE right_key END ';
        $sql      .= 'WHERE right_key > ' . $right_id;
        $this->query($sql);
        return true;
    }
}