<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserMarchentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-marchent-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'auth_key') ?>

    <?= $form->field($model, 'password_hash') ?>

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

    <?php // echo $form->field($model, 'auth_token') ?>

    <?php // echo $form->field($model, 'subscribe_date') ?>

    <?php // echo $form->field($model, 'avatar') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'affiliated_to') ?>

    <?php // echo $form->field($model, 'affiliated_with') ?>

    <?php // echo $form->field($model, 'interview_time') ?>

    <?php // echo $form->field($model, 'year_of_experience') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'verification_token') ?>

    <?php // echo $form->field($model, 'category_id') ?>

    <?php // echo $form->field($model, 'pay_service') ?>

    <?php // echo $form->field($model, 'priorities') ?>

    <?php // echo $form->field($model, 'first_payment') ?>

    <?php // echo $form->field($model, 'work_tolerance') ?>

    <?php // echo $form->field($model, 'teamwork') ?>

    <?php // echo $form->field($model, 'work_permanently') ?>

    <?php // echo $form->field($model, 'communication_skills') ?>

    <?php // echo $form->field($model, 'verification_email') ?>

    <?php // echo $form->field($model, 'action_user') ?>

    <?php // echo $form->field($model, 'contract_path') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'access_token') ?>

    <?php // echo $form->field($model, 'expire_at') ?>

    <?php // echo $form->field($model, 'school_id') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
