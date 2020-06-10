<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */
/* @var $form yii\widgets\ActiveForm */

$dataAvatar = [];
if (!$model->isNewRecord) {

    // $dataAvatar = [
    //     'initialPreview' => [
    //         Yii::getAlias('@web') . '/schools/'. $model->id.'/index' . $model
    //     ],

    //     'initialPreviewAsData' => true,
    //     'initialCaption' => $model->avatar,
    //     'initialPreviewConfig' => [
    //         ['caption' => $model->name],
    //     ],
    //     'overwriteInitial' => false,
    // ];
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
        'pluginOptions' => $dataAvatar
    ]);
    ?>

    <?= $form->field($model, 'images_school[]')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*', 'multiple' => true],
        'pluginOptions' => $dataAvatar
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>