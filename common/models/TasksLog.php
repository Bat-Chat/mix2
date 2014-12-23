<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tasks_log".
 *
 * @property integer $id
 * @property integer $task_id
 * @property string $from_time
 * @property string $to_time
 * @property integer $number_of_executions
 * @property integer $executed_times
 */
class TasksLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['task_id', 'from_time', 'to_time', 'number_of_executions'], 'required'],
            [['task_id', 'number_of_executions', 'executed_times'], 'integer'],
            [['from_time', 'to_time'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/interval', 'ID'),
            'task_id' => Yii::t('app/interval', 'Task ID'),
            'from_time' => Yii::t('app/interval', 'From Time'),
            'to_time' => Yii::t('app/interval', 'To Time'),
            'number_of_executions' => Yii::t('app/interval', 'Number Of Executions'),
            'executed_times' => Yii::t('app/interval', 'Executed Times'),
        ];
    }
}
