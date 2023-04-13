<?php
use core\Migration;
                  
class m230413_055303_create_maps_table extends Migration
{
    public function up()
    {
        $this->query("CREATE TABLE `maps` (
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(250) NOT NULL COLLATE 'utf8mb4_unicode_ci',
            `background_path` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
            `canvas_json` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_bin',
            PRIMARY KEY (`id`) USING BTREE,
            UNIQUE INDEX `maps_id_uindex` (`id`) USING BTREE
            )
            COLLATE='utf8mb4_unicode_ci'
            ENGINE=InnoDB
            AUTO_INCREMENT=38
        ;");
    }

     public function down() {
         $this->query("DROP TABLE `maps`;");
     }
}