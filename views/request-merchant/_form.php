<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use conquer\select2\Select2Widget;
use app\models\Area;
use app\models\Nationality;
use app\models\Governorate;
use app\models\Categories;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchant */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, "user_id")->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(User::find()->where(['type' => User::MERCHANT_USER])->all(), 'id', 'name')
                ]
            );
            ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "job_title")->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "category_id")->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Categories::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
      

        </div>
        <div class="col-md-2">
            <?= $form->field($model, "number_of_houer")->textInput() ?>

        </div>
        <div class="col-md-2">
            <?= $form->field($model, "nationality")->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                ]
            );  ?>
        </div>
        <div class="col-md-2">
            <?=$form->field($model, "gender")->dropDownList([ 1=> "ذكر", 2 =>"انثى" ],['prompt'=>'لا يهم']); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($model, "governorate")->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "area")->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "agree_from")->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "agree_to")->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "salary_from")->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "salary_to")->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, "desc_job")->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, "note")->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>