<?php

use app\models\Categories;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SendJob */
/* @var $form yii\widgets\ActiveForm */

$arrayCatgories = ArrayHelper::map(Categories::find()->all(), 'id', 'name_ar');
?>


<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'area-form']); ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?= $form->field($model, 'category[]')
                    ->checkboxList($arrayCatgories, ['class' => 'checkbox']) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send_Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>