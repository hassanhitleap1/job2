<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\MerchantSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="merchant-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>



    <?= $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'agree') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'nationality') ?>

    <?php // echo $form->field($model, 'certificates') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'governorate') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'expected_salary') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'name_company') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
