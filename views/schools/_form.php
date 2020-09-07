<?php

use coderius\pell\Pell;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$dataLogo = [];
$dataImages = [];

$images_path_schools = [];


if (!$model->isNewRecord) {
    foreach ($model->imagesSchools as $key => $value) {
        $images_path_schools[] = Yii::getAlias('@web') . '/' . $value['path'];
    }

    $dataLogo = [
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->path_logo,
        ],
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->path_logo,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,

    ];
    $dataImages = [
        'initialPreview' => $images_path_schools,
        'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->path_logo,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,

    ];
}
?>


<div class="container">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'school_key')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'youtube')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">

        <div class="col-md-6">
            <?= $form->field($model, 'twitter')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'location')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'details')->widget(Pell::className(), []); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'director_word')->widget(Pell::className(), []); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'discounts_form')->widget(Pell::className(), []); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'map')->widget(Pell::className(), []); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'brochure')->widget(Pell::className(), []); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'contact_information')->widget(Pell::className(), []); ?>
        </div>
    </div>



    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataLogo
            ]);
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'images_school[]')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*', 'multiple' => true],
                'pluginOptions' => $dataImages
            ]);
            ?>
        </div>
    </div>










    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>