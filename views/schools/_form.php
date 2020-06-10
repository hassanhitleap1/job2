<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */
/* @var $form yii\widgets\ActiveForm */
?>


    <div class="container">

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
            <?= $form->field($model, 'logo')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataAvatar
            ]);
            ?>

        <?= $form->field($model, 'images_school[]')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*','multiple' => 'multiple'],
            'pluginOptions' => $dataAvatar
        ]);
        ?>

            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
  