<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use app\models\Nationality;
use app\models\Governorate;
use app\models\Area;
use app\models\Categories;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use Carbon\Carbon;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */
/* @var $form yii\widgets\ActiveForm */

$dataAvatar = [];
$date=($model->isNewRecord)?Carbon::now("Asia/Amman"):$model->created_at;
$today=Carbon::now("Asia/Amman");

$communication_skills=50;
$work_tolerance=50;
$teamwork=50;
$work_permanently=50;
if(! $model->isNewRecord ){
    $communication_skills=$model->communication_skills;
    $work_tolerance=$model->work_tolerance;
    $teamwork=$model->teamwork;
    $work_permanently=$model->work_permanently;
}

if (!$model->isNewRecord && $model->avatar != "") {

    $dataAvatar = [
        'initialPreview' => [
            Yii::getAlias('@web') . '/' . $model->avatar
        ],

        'initialPreviewAsData' => true,
        'initialCaption' => $model->avatar,
        'initialPreviewConfig' => [
            ['caption' => $model->name],
        ],
        'overwriteInitial' => false,
    ];
}

?>
<div class="container">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'phone')->textInput() ?>
        </div>
    
        <div class="col-md-2">
            <?= $form->field($model, 'agree')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'nationality')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'governorate')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'area')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'category_id')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Categories::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'subscribe_date')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => Yii::t('app', 'Enter_date')],
                'value' => Carbon::now('Asia/Amman')->toDateString(),
                'type' => DatePicker::TYPE_COMPONENT_APPEND,
                // 'value'=>Carbon::now('Asia/Amman')->toDateString(),
                // 'pickerIcon' => '<i class=" text-primary"></i>',
                // 'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                'pluginOptions' => [
                    'todayHighlight' => true,
                    'todayBtn' => true,
                    'autoclose' => false,
                    'format' => 'yyyy-mm-dd',


                ]
            ]); ?>

        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'expected_salary')->textInput() ?>
        </div>

    </div>
    <div class="row">
        
        <div class="col-md-3">
            <?= $form->field($model, 'year_of_experience')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'work_tolerance')->textInput(['value'=>$work_tolerance]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'teamwork')->textInput(['value'=>$teamwork]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'work_permanently')->textInput(['value'=>$work_permanently]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'communication_skills')->textInput(['value'=>$communication_skills]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'priorities')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        
        <div class="col-md-6">
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'affiliated_with')->textInput() ?>
            <?= $form->field($model, 'affiliated_to')->textInput() ?>
            <?= $form->field($model, 'interview_time')->textInput() ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataAvatar
            ]);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>