<?php

use app\models\Expense;
use app\models\Sources;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\ExpenseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Expenses';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Expense', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);
    //

     ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'showFooter'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',


            [
                'attribute'=>'source',
                'value'=>'sourceModel.name',
                'filter'=>ArrayHelper::  map(Sources::find()->all(),'id', 'name'),
            ],
            [
                    'attribute'=>'amount',
                    'footer'=>'Total Outstanding: '.Expense::getTotalOutstandingAmount(),
                    'footerOptions' => [
                        'class' => 'not-set', // add css class for label // add style for label
                        'content' => 'Total Outstanding:', // add content for label
                    ],
            ],
            [
                    'attribute'=>'month',
                    'filter'=>ArrayHelper::map(Expense::find()->select('month')->distinct()->all(),'month','month'),

            ],
            //'expenseDate',
            //'createdAt',
            [
                    'attribute'=>'isPaid',
                    'label'=>'Payment Status',
                    'value'=>function($model)
                    {
                        return Expense::IS_PAID[$model->isPaid]??'N/A';
                    },
                    'filter'=>ArrayHelper::map(array(['id'=>1,'value'=>'Paid'],['id'=>0,'value'=>'Unpaid']),'id','value')
                    //'filter'=>ArrayHelper::map()

            ],


            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Expense $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
