<?php
use core\Migration;

class m230304_121840_add_template_id_column extends Migration
{
     public function up() {
         $this->query("ALTER TABLE `menu`
            ADD COLUMN `template_id` INT(11) NULL AFTER `menu_id`,
            ADD CONSTRAINT `FK_menu_templates` FOREIGN KEY (`template_id`) REFERENCES `templates` (`id`) ON UPDATE NO ACTION ON DELETE NO ACTION;");
     }

     public function down() {
         $this->query("ALTER TABLE `menu`
            DROP COLUMN `template_id`,
            DROP FOREIGN KEY `FK_menu_templates`;");
     }
}