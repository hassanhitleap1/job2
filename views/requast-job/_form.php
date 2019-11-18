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
            <?= $form->field($model, 'affiliated_with')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'affiliated_to')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'interview_time')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'year_of_experience')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'certificates')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'experience')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => $dataAvatar
            ]);
            ?>
        </div>
    </div>
    <!-- <div class="row">
       <div class="col-md-6">
                <h2> تاريخ الارسال في  <?php// $date->addDays(2)->toDateString();?></h2>
       </div> 
       <div class="col-md-6">
            <h2> تاريخ الارسال في  <?php //$date->addDays(9)->toDateString();?></h2>
       </div> 
    </div> -->
    <!-- <div class="row">
        <div class="col-md-3">
            <label for="assigns_to[0][0]"><?php //Yii::t('app', 'Affiliated_With')?> </label>
            <input type="text" class="form-control" id="assigns_to[0][0]" name="RequastJob[assigns_to[0][0]]" >
        </div>
        <div class="col-md-3">
            <label for="assigns_to[1][0]"><?php //Yii::t('app', 'Affiliated_With')?></label>
            <input type="text" class="form-control" id="assigns_to[1][0]" name="RequastJob[assigns_to[1][0]]">
        </div>
        <div class="col-md-3">
            <label for="assigns_to[2][0]"><?php //Yii::t('app', 'Affiliated_With')?></label>
            <input type="text" class="form-control" id="assigns_to[2][0]" name="RequastJob[assigns_to[2][0]]">
        </div>
        <div class="col-md-3">
            <label for="assigns_to[3][0]"><?php//Yii::t('app', 'Affiliated_With')?></label>
            <input type="text" class="form-control" id="assigns_to[3][0]" name="RequastJob[assigns_to[3][0]]">
        </div>
    </div> -->

    <!-- <div class="row">
       <div class="col-md-6">
            <h2> تاريخ الارسال في  <?php //$date->addDays(16)->toDateString();?></h2>
       </div> 
       <div class="col-md-6">
            <h2> تاريخ الارسال في  <?php //$date->addDays(23)->toDateString();?></h2>
       </div> 
    </div> -->
    <!-- <div class="row">
        <div class="col-md-3">
            <label for="assigns_for[0][1]"><?php //Yii::t('app', 'Affiliated_To')?></label>
            <input type="text" class="form-control" id="assigns_for[0][1]" name="RequastJob[assigns_for[0][1]]">
        </div>
        <div class="col-md-3">
            <label for="assigns_for[1][1]"><?php//Yii::t('app', 'Affiliated_To')?></label>
            <input type="text" class="form-control" id="assigns_for[1][1]" name="RequastJob[assigns_for[1][1]]">
        </div>
        <div class="col-md-3">
            <label for="assigns_for[2][1]"><?php //Yii::t('app', 'Affiliated_To')?></label>
            <input type="text" class="form-control" id="assigns_for[2][1]" name="RequastJob[assigns_for[2][1]]">
        </div>
        <div class="col-md-3">
            <label for="assigns_for[3][1]"><?php //Yii::t('app', 'Affiliated_To')?></label>
            <input type="text" class="form-control" id="assigns_for[3][1]" name="RequastJob[assigns_for[3][1]]">
        </div>
    </div> -->
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