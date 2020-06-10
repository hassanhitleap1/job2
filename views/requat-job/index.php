<?php

use app\models\Area;

use app\models\Governorate;
use app\models\Nationality;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Requast_Job');

?>

<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>

                <div class="col-lg-2">
                    <?= $form->field($model, 'phone')->textInput() ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'email')->textInput() ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'confirm_pass')->passwordInput()->label(Yii::t('app', 'Conf_Password'))  ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"]); ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'agree')->textInput() ?>
                </div>
                <div class="col-lg-2">
                    <?= $form->field($model, 'nationality')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Nationality::find()->where(['<>', 'id', 1])->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>
                <div class="col-md-3">
                    <?= $form->field($model, 'governorate')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>

                <div class="col-md-3">
                    <?= $form->field($model, 'area')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Area::find()->where(['<>', 'id', 1])->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>
            </div>
            <div class="row">
                <?php include('edu_att.php') ?>
            </div>
            <div class="row">
                <?php include('experience.php') ?>
            </div>
            <div class="row">
                <?php include('courses.php') ?>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <?= $form->field($model, 'i_agree')->checkBox([
                            'label' => Yii::t('app', 'I_Agree') , 'data-size' => 'small', 'class' => 'bs_switch', 'style' => 'margin-bottom:4px;', 'id' => 'active'
                        ]) ?>
                        <?= Html::a(Yii::t('app', 'Terms_Conditions'), ['/site/terms-conditions']) ?>
                        <?=Yii::t('app', 'And')?>
                        <?= Html::a(Yii::t('app', 'Privacy_Policy'), ['/site/privacy-policy']) ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg ']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>