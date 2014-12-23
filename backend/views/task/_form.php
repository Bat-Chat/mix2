<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Interval;
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Task */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="task-form">

		<?php $form = ActiveForm::begin(); ?>

		<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>

		<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

		<?= $form->field($model, 'done')->textInput() ?>

		<?= $form->field($model, 'number_of_executions')->textInput() ?>

		<?= $form->field($model, 'interval_id')->dropDownList(
			ArrayHelper::map(Interval::find()->all(), 'id', 'title'),
			['prompt'=>'Select interval']
		);?>

		<?
			// DatePicker::widget([
			// 	'model' => $model,
			// 	'attribute' => 'start_date',
			// 	'template' => '{addon}{input}',
			// 	'clientOptions' => [
			// 		'autoclose' => true,
			// 		'format' => 'yyyy-m-d'
			// 	]
			// ]);
		?>

		<div class="form-group">
				<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>

		<?php ActiveForm::end(); ?>

</div>
