<?php

use yii\db\Schema;
use yii\db\Migration;

class m140928_143536_addColumnsIntoTask extends Migration
{
    public function up()
    {
    	$this->addColumn('{{%task}}', 'interval', Schema::TYPE_STRING . ' DEFAULT NULL');
    	$this->addColumn('{{%task}}', 'start_date', Schema::TYPE_DATE . ' DEFAULT NULL');
    	$this->addColumn('{{%task}}', 'number_of_executions', Schema::TYPE_INTEGER . ' DEFAULT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%task}}', 'interval');
    	$this->dropColumn('{{%task}}', 'start_date');
    	$this->dropColumn('{{%task}}', 'number_of_executions');
    }
}
