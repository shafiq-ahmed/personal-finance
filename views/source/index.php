<?php

use app\models\Sources;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var \app\models\search\SourcesSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Sources';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sources-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Sources', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            [
                    'attribute'=>'isPrimary',
                    'label'=>'Primary',
                    'value'=>function($model)
                    {
                        return Sources::IS_PRIMARY[$model->isPrimary]??'N/A';
                    },
                    'filter'=>ArrayHelper::map(Sources::getAllIsPrimaryKeyValues(),'id','value')
            ],
            'currentBalance',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Sources $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
