<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Upload_Video_Me');

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
$dataVedio = [];

if (! is_null($model)) {
    $path = Yii::getAlias('@webroot') . '/' .  $model->path;
    $path_web = Yii::getAlias('@web') . '/' .  $model->path;
    if (file_exists($path)) {
        $is_uploaded = true;
        $dataVedio = [
            'initialPreview' => [
                $path_web,
            ],
            'initialPreviewAsData' => true,
            'initialCaption' => Yii::$app->user->identity->name,
            'initialPreviewConfig' => [
                ['caption' => Yii::$app->user->identity->name],
            ],
            'overwriteInitial' => false,

        ];
    }
}
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <?php if (Yii::$app->session->has('message')) : ?>
            <div class="alert alert-success" role="alert">
                <h3><?php echo Yii::$app->session->get('message'); ?></h3>
            </div>
            <?php Yii::$app->session->remove('message'); ?>
        <?php endif; ?>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="row">
                    <div class="col-md-2 col-lg-2">
                        <?=  $form->field($model,'status')->checkBox( ["id"=>"status_vedio_user"]);?>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'vedio/*'],
                            'pluginOptions' => $dataVedio
                        ]); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group">
                            <?php if (!$is_uploaded) : ?>
                                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

    </div>