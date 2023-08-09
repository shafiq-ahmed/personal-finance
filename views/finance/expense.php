<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expense $model */
/** @var ActiveForm $form */
?>
<div class="finance-expense">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>
        <?= $form->field($model, 'amount') ?>
        <?= $form->field($model, 'month') ?>
        <?= $form->field($model, 'createdAt') ?>
        <?= $form->field($model, 'isPaid') ?>
        <?= $form->field($model, 'source') ?>
        <?= $form->field($model, 'expenseDate') ?>
    
        <div class="form-group">
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- finance-expense -->
