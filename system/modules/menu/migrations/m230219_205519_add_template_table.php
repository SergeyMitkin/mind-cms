<?php
use core\Migration;
                  
class m230219_205519_add_template_table extends Migration
{
    public function up() {
        $this->query("ALTER TABLE `menu`
	ADD COLUMN `template` VARCHAR(250) DEFAULT '' AFTER `icon`;");
    }

    public function down() {
        $this->query("ALTER TABLE `menu`
	DROP COLUMN `template`;");
    }
}