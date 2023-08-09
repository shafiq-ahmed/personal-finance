<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Sources $model */

$this->title = 'Create Sources';
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
