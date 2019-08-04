<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use app\models\Governorate;
use app\models\Area;

/* @var $this yii\web\View */
/* @var $model app\models\Merchant */
/* @var $form yii\widgets\ActiveForm */
?>




<div class="container">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-6">


            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput() ?>


           



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

             
            </div>
            <div class="col-md-6">
            <?= $form->field($model, 'name_company')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>