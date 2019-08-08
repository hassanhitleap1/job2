<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use app\models\Nationality;
use app\models\Governorate;
use app\models\Area;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */
/* @var $form yii\widgets\ActiveForm */
?>
    <div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-3">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'phone')->textInput() ?>
            </div>
            <div class="col-md-3">
              <?= $form->field($model, 'agree')->textInput() ?>
            </div>
            <div class="col-md-3">
                <?= $form->field($model, 'nationality')->widget(
                    Select2Widget::className(),
                    [
                        'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                    ]
                ); ?>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'governorate')->widget(
                    Select2Widget::className(),
                    [
                        'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                    ]
                ); ?>
        </div>
        <div class="col-md-4">
         <?= $form->field($model, 'area')->widget(
                    Select2Widget::className(),
                    [
                        'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                    ]
                ); ?>
        </div>
        <div class="col-md-4">
                <?= $form->field($model, 'expected_salary')->textInput() ?>
            </div>
        </div>
            <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>
            </div>
            <div class="col-md-6">
            <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
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














</div>