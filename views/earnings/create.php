<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Earnings $model */

$this->title = 'Create Earnings';
$this->params['breadcrumbs'][] = ['label' => 'Earnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="earnings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
