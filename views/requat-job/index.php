<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use app\models\Nationality;
use app\models\Governorate;
use app\models\Area;
?>

<div class="requast-job-form">

    <div class="panel panel-default">
        <div class="panel-heading">sssss</div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(); ?>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'agree')->textInput() ?>
                    <?= $form->field($model, 'phone')->textInput() ?>
                    <?= $form->field($model, 'nationality')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>

                    <?= $form->field($model, 'governorate')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>

                    <?= $form->field($model, 'area')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                        ]
                    ); ?>
                   

                    <?= $form->field($model, 'expected_salary')->textInput() ?>


                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>

                    <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>


                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

</div>