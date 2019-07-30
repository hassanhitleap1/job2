<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use app\models\Area;
use app\models\Nationality;
use app\models\Governorate;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchant */
/* @var $form yii\widgets\ActiveForm */
?>


    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_company')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone')->textInput() ?>

    <?= $form->field($model, 'avg_agree')->textInput() ?>

    <?= $form->field($model, 'job_title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc_job')->textarea(['rows' => 6]) ?>
    

    <?= $form->field($model, 'nationality')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
    <?= $form->field($model, 'governorate')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>

    <?= $form->field($model, 'area')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                        ]
                    ); ?>

    <?= $form->field($model, 'avg_salary')->textInput() ?>

    <?= $form->field($model, 'number_of_houer')->textInput() ?>

    <?= $form->field($model, 'note')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>


