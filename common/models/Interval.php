<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "interval".
 *
 * @property integer $id
 * @property string $title
 * @property integer $default_interval_id
 * @property integer $iteration
 */
class Interval extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%interval}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'default_interval_id', 'iteration'], 'required'],
            [['default_interval_id', 'iteration'], 'integer'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/interval', 'ID'),
            'title' => Yii::t('app/interval', 'Title'),
            'default_interval_id' => Yii::t('app/interval', 'Default Interval ID'),
            'iteration' => Yii::t('app/interval', 'Iteration'),
        ];
    }
}
