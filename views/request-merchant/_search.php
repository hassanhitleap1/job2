<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-merchant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'job_title') ?>

    <?= $form->field($model, 'desc_job') ?>

    <?= $form->field($model, 'salary_from') ?>

    <?= $form->field($model, 'salary_to') ?>

    <?php // echo $form->field($model, 'agree_from') ?>

    <?php // echo $form->field($model, 'agree_to') ?>

    <?php // echo $form->field($model, 'governorate') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'number_of_houer') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
