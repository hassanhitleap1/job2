<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Governorate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'area-form']); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'name_ar')->textInput(['maxlength' => true]) ?>
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
    </div>

