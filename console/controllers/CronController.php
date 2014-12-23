<?php
namespace console\controllers;
 
use Yii;
use common\models\Task;
use common\models\TasksLog;
use yii\console\Controller;
 
/**
 * Контроллер для работы с cron
 */
class CronController extends Controller {
 
    public function actionIndex() {
        Yii::info('===========HELLO FROM CRON=================', 'orders');

        $this->addDailyTaskLog();
        $this->addWeeklyTaskLog();
        // TODO проверить или правильно записывает месячные задания
        $this->addMonthlyTaskLog();
    }

    /**
     * Добавить запись выполнегоно задания с интервавлом в день
     * 
     * @return mixed
     */
    public function addDailyTaskLog()
    {
        $this->addTaskLog(2, 'today', 'today -1 day');
    }

    /**
     * Добавить запись выполнегоно задания с интервавлом в неделю
     * 
     * @return mixed
     */
    public function addWeeklyTaskLog()
    {
        $this->addTaskLog(3, 'Monday this week', 'Monday this week -1 week');
    }

    /**
     * Добавить запись выполнегоно задания с интервавлом в месяц
     * 
     * @return mixed
     */
    public function addMonthlyTaskLog()
    {
        $this->addTaskLog(4, 'First day of this month', 'First day of this month -1 month');
    }

    /**
     * Добавить запись выполнегоно задания с заданным интервавлом
     * 
     * @return mixed
     */
    public function addTaskLog($intervalId, $time, $fromTime)
    {
        $tasks = Task::find()->where(['interval_id' => $intervalId])->all();
        foreach ($tasks as $task) {
            $tasksLog = TasksLog::find()->where(['task_id' => $task->id])->orderBy('id DESC')->one();

            // если задание было начато cегодня
            // TODO подумать пригодится ли "start_date"
            // if (strtotime($task->start_date) >= strtotime($time, time())) {
            //     continue;
            // }

            $needLog = $tasksLog ? (strtotime($tasksLog->to_time) < strtotime($time, time()) ? true : false) : true;
            if ($needLog) {
                $newLog = new TasksLog;
                $newLog->task_id = $task->id;
                $newLog->from_time = date('Y-m-d G:i:s', strtotime($fromTime, time()));
                $newLog->to_time = date('Y-m-d G:i:s', strtotime($time, time()));
                $newLog->number_of_executions = $task->number_of_executions;
                $newLog->executed_times = $task->done;
                $newLog->save();

                $task->done = 0;
                $task->save();
            }
        }
    }
}