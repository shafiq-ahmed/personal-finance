<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Earnings $model */

$this->title = 'Update Earnings: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Earnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="earnings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
