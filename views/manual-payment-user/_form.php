<?php

use app\models\User;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ManualPaymentUser */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "user_id")->widget(
        Select2Widget::className(),
        [
            'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_USER])->all(), 'id', 'name')
        ]
    );
    ?>

    <?= $form->field($model, 'amount')->textInput() ?>

    <?= $form->field($model, 'is_first_payment')->checkbox(['YES' => 1, 'NO' => 0]);?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
