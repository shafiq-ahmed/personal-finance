<?php

use app\models\Expense;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Expense $model */
/** @var string $sourceName */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="expense-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>

    <!--   Make payment button shown if isPaid attribute of model is set to 0 -->
        <?php
            if($model->isPaid==0) {
               echo Html::a('Make payment', ['payment', 'id' => $model->id], ['class' => 'btn btn-primary']) ;
        }
        ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            ['attribute'=>'source',
                'value'=>$sourceName,
            ],
            'amount',
            'month',
            [
                    'attribute'=>'expenseDate',
                    'label'=>'Expense Date',
                    'value'=>function($model)
                    {
                        return date('d-M-Y',strtotime($model->expenseDate));
                    }
            ],
            'createdAt',
            [
                'attribute' => 'isPaid',
                'label'=>'Payment Status',
                'value' => function ($model) {
                    return Expense::IS_PAID[$model->isPaid] ?? 'N/A';
                }
            ]
        ],
    ]) ?>

</div>
