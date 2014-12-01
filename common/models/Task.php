<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;

/**
 * Task model
 *
 * @property integer $id
 * @property string $title
 * @property boolean $done
 * @property string $interval
 * @property date $start_date
 * @property string $description
 * @property integer $number_of_executions
 */
class Task extends ActiveRecord
{

		/**
		 * Массив доступных значений для поля интервал
		 * TODO перенести в настройки (типа Core Settings)
		 */
		public static function tableName()
		{
				return '{{%task}}';
		}

		/**
		 * @inheritdoc
		 */
		public $intervalValues = [
			'hour',
			'day',
			'week',
			'month',
			'year'
		];

		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
				return [
						// TimestampBehavior::className(),
				];
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
				return [
						[['title'], 'string', 'length' => [4, 45]],
						[['description'], 'string', 'length' => [4, 45]],
						[['done'], 'safe'],
						[['start_date'], 'safe'],
						[['interval'], 'safe'],
						[['number_of_executions'], 'safe'],
						// ['status', 'default', 'value' => self::STATUS_ACTIVE],
						// ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],

						// ['role', 'default', 'value' => self::ROLE_USER],
						// ['role', 'in', 'range' => [self::ROLE_USER]],
				];
		}

		/**
		 * @inheritdoc
		 */
		public function getId()
		{
				return $this->getPrimaryKey();
		}
}
