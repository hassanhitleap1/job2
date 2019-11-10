<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'Send_Sms');
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'send-sms']); ?>
            <div class="row">
                <div class="col-lg-12">
                    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Send_Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>