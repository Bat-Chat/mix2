<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Task */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tasks'), 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $this->registerJs("
	$('.dial').knob();",
	yii\web\View::POS_READY); 

// print_r($model);die;
?>

<div class="task-view">

	<h1><?= Html::encode($this->title) ?></h1>

	<p>
		<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
		<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
				'method' => 'post',
			],
		]) ?>
	</p>

	<input type="text" value="<?= $this->context->rateTime ?>" class="dial">

	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'id',
			'title',
			'description:ntext',
			'done',
			'number_of_executions'
		],
	]) ?>

</div>
