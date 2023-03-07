<?php
use core\Migration;
                  
class m230217_214055_add_menu_id_column extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `menu_id` INT(11) DEFAULT 0 NULL AFTER `type`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `menu_id`;");
     }
}