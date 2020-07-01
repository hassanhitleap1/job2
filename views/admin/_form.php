<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="admin-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'agree')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nationality')->textInput() ?>

    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'governorate')->textInput() ?>

    <?= $form->field($model, 'area')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'expected_salary')->textInput() ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'name_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'subscribe_date')->textInput() ?>

    <?= $form->field($model, 'avatar')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gender')->textInput() ?>

    <?= $form->field($model, 'affiliated_to')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'affiliated_with')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'interview_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'year_of_experience')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'pay_service')->textInput() ?>

    <?= $form->field($model, 'priorities')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'first_payment')->textInput() ?>

    <?= $form->field($model, 'work_tolerance')->textInput() ?>

    <?= $form->field($model, 'teamwork')->textInput() ?>

    <?= $form->field($model, 'work_permanently')->textInput() ?>

    <?= $form->field($model, 'communication_skills')->textInput() ?>

    <?= $form->field($model, 'verification_email')->textInput() ?>

    <?= $form->field($model, 'action_user')->textInput() ?>

    <?= $form->field($model, 'contract_path')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
