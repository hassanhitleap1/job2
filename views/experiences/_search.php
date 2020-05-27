<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ExperiencesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="experiences-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'month_from_exp') ?>

    <?= $form->field($model, 'year_from_exp') ?>

    <?php // echo $form->field($model, 'month_to_exp') ?>

    <?php // echo $form->field($model, 'year_to_exp') ?>

    <?php // echo $form->field($model, 'facility_name') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
