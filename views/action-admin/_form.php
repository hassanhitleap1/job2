<?php

use app\models\User;
use Carbon\Carbon;
use conquer\select2\Select2Widget;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ActionAdmin */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, "user_id")->widget(
        Select2Widget::className(),
        [
            'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_USER])
                ->orwhere(['type' => User::NORMAL_USER])
                ->orwhere(['type' => User::NORMAL_USER_IGNORAE])->all(), 'id', 'name')
        ]
    );
    ?>


    <?= $form->field($model, "admin_id")->widget(
        Select2Widget::className(),
        [
            'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_ADMIN])->all(), 'id', 'name')
        ]
    );
    ?>

    <?= $form->field($model, 'action')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => Yii::t('app', 'Enter_date')],
        'value' => Carbon::now('Asia/Amman')->toDateString(),
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'todayHighlight' => true,
            'todayBtn' => true,
            'autoclose' => false,
            'format' => 'yyyy-mm-dd',


        ]
    ]); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
