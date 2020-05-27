<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Experiences */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="experiences-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'month_from_exp')->textInput() ?>

    <?= $form->field($model, 'year_from_exp')->textInput() ?>

    <?= $form->field($model, 'month_to_exp')->textInput() ?>

    <?= $form->field($model, 'year_to_exp')->textInput() ?>

    <?= $form->field($model, 'facility_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
