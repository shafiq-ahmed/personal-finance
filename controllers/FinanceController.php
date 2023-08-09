<?php

namespace app\controllers;

class FinanceController extends \yii\web\Controller
{
    public function actionEarning()
    {
        return $this->render('earning');
    }

    public function actionExpense()
    {
        return $this->render('expense');
    }

    public function actionTransactionSource()
    {
        return $this->render('transaction-source');
    }

}
