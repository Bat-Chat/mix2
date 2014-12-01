<?php

use yii\db\Schema;
use yii\db\Migration;

class m140827_193026_createTableTask extends Migration
{
    public function up()
    {
    	$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%task}}', [
            'id' => Schema::TYPE_PK,
            'title' => Schema::TYPE_STRING . ' NOT NULL',
            'description' => Schema::TYPE_TEXT . ' NOT NULL',
            'done' => Schema::TYPE_BOOLEAN . ' DEFAULT FALSE',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%task}}');
    }
}
