<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EducationalAttainment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'specialization')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'university')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_get')->textInput() ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
