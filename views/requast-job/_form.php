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
        <div class="col-md-3">
            <?= $form->field($model, 'agree')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'nationality')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
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
                    'items' => ArrayHelper::map(Categories::find()->all(), 'name_ar', 'name_ar')
                ]
            ); ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'expected_salary')->textInput() ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'subscribe_date')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => Yii::t('app','Enter_date')],
                    'value' => Carbon::now('Asia/Amman')->toDateString(),
                    'type' => DatePicker::TYPE_COMPONENT_APPEND,
                    // 'value'=>Carbon::now('Asia/Amman')->toDateString(),
                    // 'pickerIcon' => '<i class=" text-primary"></i>',
                    // 'removeIcon' => '<i class="fas fa-trash text-danger"></i>',
                    'pluginOptions' => [
                        'todayHighlight' => true,
                        'todayBtn' => true,
                        'autoclose'=>false,
                        'format' => 'yyyy-mm-dd',
                        
                    ]
            ]);?>

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