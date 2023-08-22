<?php

use app\models\Earnings;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \app\models\search\EarningsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Earnings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="earnings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Earnings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute'=>'source',
                    'value'=>function($model)
                    {

                        return $model->sourceModel->name;
                    }
            ],
            'previousBalance',
            'inflowDescription',
            'inflowAmount',
            //'createdAt',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Earnings $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
