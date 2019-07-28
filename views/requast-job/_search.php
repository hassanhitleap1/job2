<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJobSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="requast-job-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'agree') ?>

    <?= $form->field($model, 'phone') ?>

    <?= $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'certificates') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'governorate') ?>

    <?php // echo $form->field($model, 'expected_salary') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
