<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'phone')->textInput(['autofocus' => true])->label(Yii::t('app', 'Phone')) ?>

                    <?= $form->field($model, 'email')->label(Yii::t('app', 'Email')) ?>
                    <?= $form->field($model, 'name_company')->label(Yii::t('app', 'Name_Company')) ?>

                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password')) ?>

                    <?= $form->field($model, 'conf_password')->passwordInput()->label(Yii::t('app', 'Conf_Password')) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'signup-button']) ?>

                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
