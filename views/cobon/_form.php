<?php

use app\models\Distributor;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Cobon */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'active')->dropDownList([1 => Yii::t("app","Active"), 0 => Yii::t("app","DiActive")]); ?>

    <?= $form->field($model, 'number_cobon')->textInput(['maxlength' => true]) ?>

  
    <?= $form->field($model, 'distributor_id')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Distributor::find()->all(), 'id', 'name')
                ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
