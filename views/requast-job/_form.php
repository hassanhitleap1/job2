<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requast-job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'agree')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'governorate')->textInput() ?>

    <?= $form->field($model, 'expected_salary')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
