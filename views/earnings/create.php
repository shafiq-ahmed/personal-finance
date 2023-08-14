<?php

use app\models\Sources;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Earnings $model */

$this->title = 'Create Earnings';
$this->params['breadcrumbs'][] = ['label' => 'Earnings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="earnings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'source')->dropDownList(
        ArrayHelper::map(Sources::find()->all(),'id','name'),
    ) ?>


    <?= $form->field($model, 'inflowDescription')->textarea() ?>

    <?= $form->field($model, 'inflowAmount')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
