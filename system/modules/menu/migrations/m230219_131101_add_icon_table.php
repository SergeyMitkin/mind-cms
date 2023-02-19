<?php
use core\Migration;
                  
class m230219_131101_add_icon_table extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `icon` VARCHAR(250) DEFAULT '' AFTER `menu_id`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `icon`;");
     }
}