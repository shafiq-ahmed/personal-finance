<?php

use app\models\Transactions;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \app\models\search\TransactionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="transactions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Transactions', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'expenseId',
                'label' => 'Expense amount',
                'value' => 'expense.amount'
            ],
            [
                'attribute' => 'source.name',
                'label' => 'Source',
                'value' => 'source.name',

            ],
            [
                'attribute' => 'createdAt',
                'value' => function ($model) {
                    return date('d-M-Y h:m:s', strtotime($model->createdAt));
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Transactions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
