<?php
use core\Migration;
                  
class m230215_141246_add_type_column_to_menu extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `type` CHAR(30) DEFAULT '0' NULL AFTER `parent_id`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `type`;");
     }
}