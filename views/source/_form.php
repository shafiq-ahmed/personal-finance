<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Sources $model */
/** @var yii\widgets\ActiveForm $form */
?>

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
