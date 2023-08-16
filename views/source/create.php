<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sources $model */

$this->title = 'Create Sources';
$this->params['breadcrumbs'][] = ['label' => 'Sources', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sources-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="sources-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'isPrimary')->radioList([1=>'Yes',0=>'No']) ?>

        <?= $form->field($model, 'currentBalance')->textInput()->label('Initial Balance') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
