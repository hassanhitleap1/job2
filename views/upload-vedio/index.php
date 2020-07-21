<?php

use app\models\NameOfJobs;
use app\models\Specialties;
use app\models\VedioUser;
use conquer\select2\Select2Widget;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Upload_Video_Me');

/* @var $this yii\web\View */
/* @var $model app\models\Area */
/* @var $form yii\widgets\ActiveForm */

$pluginOptions = [
    'overwriteInitial' => true,
    'showUpload' => false,
    'allowedFileExtensions' => ['mp4'],
    'initialPreviewAsData' => true,
    'initialPreviewFileType' => 'video',
    'initialPreviewConfig' => [
        ['filetype' => "video/mp4"]
    ],
];
$is_uploaded = false;

if (!$model->isNewRecord) {
    $path = Yii::getAlias('@webroot') . '/' .  $model->path;
    $path_web = Yii::getAlias('@web') . '/' .  $model->path;
    if (file_exists($path)) {

        $is_uploaded = true;
        $pluginOptions = [
            'initialPreview' => $path_web,
            'overwriteInitial' => true,
            'showUpload' => false,
            'allowedFileExtensions' => ['mp4'],
            'initialPreviewAsData' => true,
            'initialPreviewFileType' => 'video',
            'initialPreviewConfig' => [
                ['filetype' => "video/mp4"]
            ],
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
                <div class="col-md-12 col-lg-12">
                    <?= $form->field($model, 'name_of_jobs_id')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(NameOfJobs::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>
                <div class="col-md-12 col-lg-12">
                    <?=
                        $form->field($model, 'file')->widget(FileInput::class, [
                            'options' => [
                                'multiple' => false,
                                'accept' => 'video/*'
                            ],
                            'pluginOptions' => $pluginOptions,
                        ]);
                    ?>

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