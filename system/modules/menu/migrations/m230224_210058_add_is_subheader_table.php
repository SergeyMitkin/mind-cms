<?php
use core\Migration;
                  
class m230224_210058_add_is_subheader_table extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
	ADD COLUMN `is_subheader` TINYINT(4) DEFAULT 0 NULL AFTER `type`;");
     }
                 
     public function down() {
         $this->query("ALTER TABLE `menu`
	DROP COLUMN `is_subheader`;");
     }
}