<?php

use app\models\Area;
use app\models\Categories;
use app\models\Governorate;
use app\models\Nationality;
use conquer\select2\Select2Widget;

use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title= Yii::t('app', 'Create_Requast_Job');
?>

<div class="container">

    <?php if (Yii::$app->session->has('message')) : ?>
        <div class="alert alert-success" role="alert">
            <h1><?php echo Yii::$app->session->get('message'); ?></h1>
        </div>
        <?php Yii::$app->session->remove('message'); ?>
    <?php else : ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
            <div class="panel-body">
            <div class="row">
                <div class="col-lg-3">
                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'phone')->textInput() ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"]); ?>
                </div>
                <div class="col-lg-3">
                    <?= $form->field($model, 'agree')->textInput() ?>

                    <?= $form->field($model, 'nationality')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>

            </div>

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'governorate')->widget(
                        Select2Widget::className(),
                        [
                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                        ]
                    ); ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'area')->textInput() ?>
                </div>

            </div>
            <div class="row">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4><i class="glyphicon glyphicon-envelope"></i><?= Yii::t('app', 'Create_Request_Merchant') ?> </h4>
                    </div>
                    <div class="panel-body">
                        <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 4, // the maximum times, an element can be cloned (default 999)
                            'min' => 1, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $modelsEducationalAttainment[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'specialization',
                                'university',
                                'year_get',
                            ],
                        ]); ?>


                        <div class="container-items">
                            <!-- widgetContainer -->
                            <?php foreach ($modelsEducationalAttainment as $index => $modelEduAt) : ?>
                                <div class="item panel panel-default">
                                    <!-- widgetBody -->
                                    <div class="panel-heading">
                                        <h3 class="panel-title pull-left"><?= Yii::t('app', 'Request_Merchant') . " {" . ($index + 1) . "}" ?> </h3>
                                        <div class="pull-right">
                                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="panel-body">
                                        <?php
                                        // necessary for update action.
                                        if (!$modelEduAt->isNewRecord) {
                                            echo Html::activeHiddenInput($modelEduAt, "[{$index}]id");
                                        }
                                        ?>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <?= $form->field($modelEduAt, "[{$index}]specialization")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelEduAt, "[{$index}]university")->textInput(['maxlength' => true]) ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?= $form->field($modelEduAt, "[{$index}]year_get")->textInput(['maxlength' => true]) ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
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

    <?php endif; ?>
</div>

<?php
$js = '

jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
   
jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
jQuery(this).html("Address: " + (index + 1))
});
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper .panel-title-address").each(function(index) {
jQuery(this).html("Address: " + (index + 1))
});
});

$(".add-item").on("click",function(e){
  governorate=$("#select2-merchant-governorate-container").val();
  $("#requestmerchant-0-governorate").val(governorate);
  area=$("select2-merchant-area-container").val();
  $("select-0-requestmerchant-0-area-container").val(area);
});

';

$this->registerJs($js);
?>
?>
<?php// require('educational_attainment.php') ?>
<?php //require('experience.php') ?>
<?php // require('courses.php') ?>
<?php // Yii::t('app', 'Courses') ?>




