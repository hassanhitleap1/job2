<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Contract');

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */
$dataDocument = [];
$is_uploaded = false;
if (!(Yii::$app->user->identity->contract_path == null || Yii::$app->user->identity->contract_path == '')) {
    $path = Yii::getAlias('@webroot') . '/' . Yii::$app->user->identity->contract_path;
    $path_web = Yii::getAlias('@web') . '/' . Yii::$app->user->identity->contract_path;
    if (file_exists($path)) {
        $is_uploaded = true;
        $dataDocument = [
            'initialPreview' => [
                $path_web,
            ],
            'initialPreviewAsData' => true,
            'initialCaption' => Yii::$app->user->identity->name,
            'initialPreviewConfig' => [
                ['caption' => Yii::$app->user->identity->name],
            ],
            'overwriteInitial' => false,
            'showUpload' => false,
            'showRemove' => false,


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
                <h1><?php echo Yii::$app->session->get('message'); ?></h1>
            </div>
            <?php Yii::$app->session->remove('message'); ?>
        <?php else : ?>
            <div class="panel-body">
                <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <?= $form->field($model, 'contract')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => $dataDocument
                        ]); ?>
                    </div>
                    <div class="col-md-6 col-lg-6" style="margin-top: 15px;">
                        <a class="btn btn-success btn-lg" href="<?= Yii::getAlias('@web') ?>/contract_company/contract.png" download>
                            <span class="glyphicon glyphicon-arrow-down"></span>
                            <?= Yii::t('app', 'Download_Contract_Png') ?>
                        </a>
                        <a class="btn btn-success btn-lg" href="<?= Yii::getAlias('@web') ?>/contract_company/contract.pdf" download>
                            <span class="glyphicon glyphicon-arrow-down"></span>
                            <?= Yii::t('app', 'Download_Contract') ?>
                        </a>
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
        <?php endif; ?>
    </div>