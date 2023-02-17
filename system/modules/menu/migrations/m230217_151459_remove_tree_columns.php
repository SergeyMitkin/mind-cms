<?php
use core\Migration;
                  
class m230217_151459_remove_tree_columns extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `level`;");
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `left_key`;");
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `right_key`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `level` INT(11) DEFAULT 0 AFTER `user_id`;");
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `left_key` INT(11) AFTER `level`;");
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `right_key` INT(11) AFTER `left_key`;");

         $this->query("UPDATE `menu` SET `level` = 0, `left_key` = 1, `right_key` = 16 WHERE id = 1");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 2, `right_key` = 3 WHERE id = 2");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 4, `right_key` = 5 WHERE id = 3");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 6, `right_key` = 7 WHERE id = 4");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 8, `right_key` = 9 WHERE id = 5");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 10, `right_key` = 11 WHERE id = 6");
         $this->query("UPDATE `menu` SET `level` = 1, `left_key` = 12, `right_key` = 13 WHERE id = 7");
     }
}