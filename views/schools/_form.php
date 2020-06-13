<?php

use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;



$dataLogo = [];
$dataImages=[];

// print_r(ArrayHelper::map($model->imagesSchools, 'id', 'path'));



if (!$model->isNewRecord) {
    $dataLogo = [
        'initialPreview' => [
            Yii::getAlias('@web') . '/'. $model->path_logo,
        ],
       'initialPreviewAsData' => true,
        'initialCaption' => Yii::getAlias('@web') . '/' . $model->path_logo,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,
        
    ];
    $dataImages = [
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->path_logo,
        ],
        'initialPreviewAsData' => true,
        'initialCaption' => $model->path_logo,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,

    ];
}
?>


<div class="container">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'details')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'director_word')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'discounts_form')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'map')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'brochure')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'contact_information')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => $dataLogo
    ]);
    ?>

    <?= $form->field($model, 'images_school[]')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'pluginOptions' => $dataImages
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>