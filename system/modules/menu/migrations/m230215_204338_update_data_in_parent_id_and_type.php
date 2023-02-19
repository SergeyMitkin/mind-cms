<?php
use core\Migration;
                  
class m230215_204338_update_data_in_parent_id_and_type extends Migration
{
     public function up() {
         $this->query("UPDATE `menu` SET `type` = 'root' WHERE id = 1");
         $this->query("UPDATE `menu` SET `parent_id` = 1 , `type` = 'child' WHERE id IN (2, 3, 4, 5, 6, 7)");
     }
                 
     public function down() {
         $this->query("UPDATE `menu` SET `parent_id` = 0 , `type` = '0' WHERE id IN (1, 2, 3, 4, 5, 6, 7)");
     }
}