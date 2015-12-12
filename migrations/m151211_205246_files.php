<?php

use yii\db\Schema;
use yii\db\Migration;

class m151211_205246_files extends Migration
{
    public function up()
    {
        $this->execute('CREATE TABLE `rod_files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8');
    }

    public function down()
    {
        echo "m151211_205246_files cannot be reverted.\n";

        return false;
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
