<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Earnings $model */
/** @var string $sourceName */

$this->title = 'Earnings Inflow';
$this->params['breadcrumbs'][] = ['label' => 'Earnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="earnings-view">

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
            [
                    'attribute'=>'name',
                    'value'=>$model->sourceModel->name,
                    'label'=>'Source Name'
            ],
            'previousBalance',
            'inflowDescription',
            'inflowAmount',
            [
                    'attribute'=>'createdAt',
                    'value'=>function($model)
                    {
                        return date('d-m-Y', strtotime($model->createdAt));
                    }
            ],
        ],
    ]) ?>

</div>
