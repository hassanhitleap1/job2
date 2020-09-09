<?php

use coderius\pell\Pell;
use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\University */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'js')->widget(Pell::className(), ['value'=>"dsds"]);?>
            <?=
            $form->field($model, 'js')->widget(Summernote::class, [
                'options' => ['placeholder' => 'Edit your blog content here...']
            ]);
            ?>
        <?= $form->field($model, 'style')->widget(Pell::className(), []);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>