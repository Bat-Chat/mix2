<?php

namespace backend\controllers;

use Yii;
use common\models\Task;
use common\models\TasksLog;
use common\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{

    // полное время задачи
    public $fullTime = null;

    // оставшиеся время задачи
    public $leftTime = null;

    // пройденное время задачи
    public $passTime = null;

    // процент пройденного времени задачи
    public $rateTime = null;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionList()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function getExecutionPercent(Task $task)
    {
        return (1/$task->number_of_executions)*100;
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function setDay()
    {
        $this->setTime(strtotime(date('Y-m-d')), strtotime('+1 day', strtotime(date('Y-m-d'))));
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function setWeek()
    {
        $this->setTime(strtotime('Monday this week', time()), strtotime('next Monday', time()));
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function setMonth()
    {
        $this->setTime(strtotime('first day of this Month', strtotime(date('Y-m-d'))), strtotime('first day of next Month', strtotime(date('Y-m-d'))));
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function setTime($start, $end)
    {
        $this->fullTime = $end - $start;
        $this->passTime = time() - $start;
        $this->leftTime = $end - time();
        $this->rateTime = bcmul(bcdiv($this->passTime, $this->fullTime, 3), 100, 1);
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function setTimeByInterval($intervalId)
    {
        date_default_timezone_set('Europe/Helsinki');

        switch ($intervalId) {
            case 1:
                return 1;
                break;
            case 2:
                $this->setDay();
                break;
            case 3:
                $this->setWeek();
                break;
            case 4:
                $this->setMonth();
                break;
            case 5:
                return (86400/604800)*100;
                break;
            default:
                return 0;
        }

        // echo '<br>';
        // echo $this->fullTime;
        // echo '<br>';
        // echo $this->passTime;
        // echo '<br>';
        // echo $this->rateTime;die;

        // echo date('Y-m-d G:i:s', time());
        // echo '<br>';
        // echo date('Y-m-d G:i:s', strtotime("+5 minutes",$e));die;
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {       
        $task = $this->findModel($id);

        if ($task->interval_id) {
           $this->setTimeByInterval($task->interval_id);
        }

        return $this->render('view', [
            'model' => $task
        ]);
    }

    

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'list' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['list']);
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
