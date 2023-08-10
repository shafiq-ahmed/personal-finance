<?php

namespace app\models;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use yii\queue\Queue;

class AddExpenseJob extends BaseObject implements JobInterface
{
    public Expense $model;

    /**
     * @param $queue
     * @return mixed|void
     */
    public function execute($queue)
    {
        $this->model->save();
    }
}