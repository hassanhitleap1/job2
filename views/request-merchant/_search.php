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

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'name_company') ?>

    <?= $form->field($model, 'phone') ?>
    
    <?= $form->field($model, 'avg_agree') ?>

    <?= $form->field($model, 'nationality') ?>

    <?php  echo $form->field($model, 'job_title') ?>

    <?php  echo $form->field($model, 'desc_job') ?>

    <?php  echo $form->field($model, 'governorate') ?>

    <?php  echo $form->field($model, 'area') ?>

    <?php  echo $form->field($model, 'avg_salary') ?>

    <?php  echo $form->field($model, 'number_of_houer') ?>

    <?php  echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
