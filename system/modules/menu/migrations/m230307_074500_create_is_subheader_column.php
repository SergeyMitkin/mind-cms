<?php
use core\Migration;

class m230307_074500_create_is_subheader_column extends Migration
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