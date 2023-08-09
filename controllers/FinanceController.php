<?php

namespace app\controllers;

use app\models\Expense;

class FinanceController extends \yii\web\Controller
{
    public function actionEarning()
    {
        return $this->render('earning');
    }

    public function actionExpense()
    {
        $model= new Expense();
        return $this->render('expense',[
            'model'=>$model
        ]);
    }

    public function actionTransactionSource()
    {
        return $this->render('transaction-source');
    }

}
