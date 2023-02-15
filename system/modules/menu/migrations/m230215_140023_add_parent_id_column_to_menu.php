<?php
use core\Migration;
                  
class m230215_140023_add_parent_id_column_to_menu extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `parent_id` INT(3) DEFAULT 0 NULL AFTER `position`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `parent_id`;");
     }
}