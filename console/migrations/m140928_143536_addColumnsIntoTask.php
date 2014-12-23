<?php

use yii\db\Schema;
use yii\db\Migration;

class m140928_143536_addColumnsIntoTask extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%interval}}', [
			'id' => Schema::TYPE_PK,
			'title' => Schema::TYPE_STRING . ' NOT NULL',
			'parent_id' => Schema::TYPE_INTEGER . ' NOT NULL',
			'iteration' => Schema::TYPE_INTEGER . ' NOT NULL',
		], $tableOptions);

		$this->insert('{{%interval}}', [
			'title' => 'Час',
		]);

		$this->insert('{{%interval}}', [
			'title' => 'День',
		]);

		$this->insert('{{%interval}}', [
			'title' => 'Неделя',
		]);

		$this->insert('{{%interval}}', [
			'title' => 'Месяц',
		]);

		$this->insert('{{%interval}}', [
			'title' => 'Год',
		]);

		$this->addColumn('{{%task}}', 'start_date', Schema::TYPE_DATE . ' DEFAULT NULL');
		$this->addColumn('{{%task}}', 'interval_id', Schema::TYPE_INTEGER . ' DEFAULT NULL');
		$this->addColumn('{{%task}}', 'number_of_executions', Schema::TYPE_INTEGER . ' DEFAULT NULL');
	}

	public function down()
	{
        $this->dropTable('{{%interval}}');

		$this->dropColumn('{{%task}}', 'start_date');
		$this->dropColumn('{{%task}}', 'interval_id');
		$this->dropColumn('{{%task}}', 'number_of_executions');
	}
}
