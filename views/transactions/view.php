<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Transactions $model */

$this->title = 'Transactions';
$this->params['breadcrumbs'][] = ['label' => 'Transactions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="transactions-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'expenseId',
            [
                'attribute'=>'expenseId',
                'label'=>'Expense amount',
                'value'=>$model->expense->amount
            ],
            'sourceId',
            [
                'attribute'=>'sourceId',
                'label'=>'Source Name',
                'value'=>$model->source->name
            ],

            [
                'attribute'=>'createdAt',
                'value'=>function($model)
                {
                    return date('d-M-Y h:m:s',strtotime($model->createdAt));
                }
            ],
        ],
    ]) ?>

</div>
