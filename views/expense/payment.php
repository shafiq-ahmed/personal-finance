<?php

use app\models\Sources;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Expense $model */

$this->title = 'Payment';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="expense-create">
    <!--Show flash error message if formdata insertion fails -->
    <?= \app\widgets\Alert::widget()?>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model,'name')->textInput ( [ 'disabled' => true]) ?>

    <?= $form->field($model, 'source')->dropDownList(
            ArrayHelper::map(Sources::find()->all(),'id','name'),
    ) ?>

    <?= $form->field($model, 'amount')->textInput ( [ 'disabled' => true]) ?>

    <?= $form->field($model, 'month')->textInput ( [ 'disabled' => true]) ?>

    <?php
    //format timestamp to show only date
    $expenseDate=Yii::$app->formatter->asDate($model->expenseDate, 'dd-MM-yyyy');
     echo $form->field($model, 'expenseDate')->textInput ( ['value' => $expenseDate,'disabled'=>true])
    ?>

    <div class="form-group">
        <?= Html::submitButton('Make Payment', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
