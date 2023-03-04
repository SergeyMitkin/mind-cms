<?php
use core\Migration;
                  
class m230304_120133_create_templates_table extends Migration
{
     public function up() {
         $this->query("CREATE TABLE `templates` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(250) NULL DEFAULT '' COLLATE 'utf8mb4_unicode_ci',
            PRIMARY KEY (`id`) USING BTREE,
            UNIQUE INDEX `name` (`id`) USING BTREE
        )
        COLLATE='utf8mb4_unicode_ci'
        ENGINE=InnoDB
        ;");

         $this->query("INSERT INTO `mind`.`templates` (`name`) VALUES (
            'first_template', 'second_template', 'third_template', 'fourth_template');");
     }
                 
     public function down() {
         $this->query("DROP TABLE `templates`;");
     }
}