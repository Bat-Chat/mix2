<?php

use yii\db\Schema;
use yii\db\Migration;

class m141211_192642_addTasksLog extends Migration
{
    public function up()
    {
    	$tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tasks_log}}', [
            'id' => Schema::TYPE_PK,
            'task_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'from_time' => Schema::TYPE_DATE . ' NOT NULL',
            'to_time' => Schema::TYPE_DATE . ' NOT NULL',
            'number_of_executions' => Schema::TYPE_INTEGER . ' NOT NULL',
            'executed_times' => Schema::TYPE_INTEGER . ' DEFAULT NULL',

        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%tasks_log}}');
    }
}
