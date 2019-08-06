<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use conquer\select2\Select2Widget;
use app\models\Area;
use app\models\Nationality;
use app\models\Governorate;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Merchant */
/* @var $form yii\widgets\ActiveForm */

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
';

$this->registerJs($js);
?>


<div class="container">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'phone')->textInput() ?>

            <?= $form->field($model, 'governorate')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                ]
            ); ?>
            <?= $form->field($model, 'area')->widget(
                Select2Widget::className(),
                [
                    'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                ]
            ); ?>


        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'name_company')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4><i class="glyphicon glyphicon-envelope"></i> Requastes</h4>
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
                    'model' => $modelsRequestMerchant[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'job_title',
                        'salary_from',
                        'salary_to', 
                        'agree_to',
                        'agree_from', 
                        'nationality',
                        'governorate',
                        'area',
                        'number_of_houer',
                        'desc_job',
                        'note',
                    ],
                ]); ?>


                <div class="container-items">
                    <!-- widgetContainer -->
                    <?php foreach ($modelsRequestMerchant as $index => $modelRequestMerchant) : ?>
                        <div class="item panel panel-default">
                            <!-- widgetBody -->
                            <div class="panel-heading">
                                <h3 class="panel-title pull-left">Rquast marchent</h3>
                                <div class="pull-right">
                                    <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                    <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <?php
                                // necessary for update action.
                                if (!$modelRequestMerchant->isNewRecord) {
                                    echo Html::activeHiddenInput($modelRequestMerchant, "[{$index}]id");
                                }
                                ?>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <?= $form->field($modelRequestMerchant, "[{$index}]job_title")->textInput(['maxlength' => true]) ?>

                                        <?= $form->field($modelRequestMerchant, "[{$index}]salary_from")->textInput() ?>

                                        <?= $form->field($modelRequestMerchant, "[{$index}]salary_to")->textInput() ?>

                                        <?= $form->field($modelRequestMerchant, "[{$index}]agree_from")->textInput() ?>

                                        <?= $form->field($modelRequestMerchant, "[{$index}]agree_to")->textInput() ?>
                                        <?= $form->field($modelRequestMerchant, "[{$index}]nationality")->widget(
                                            Select2Widget::className(),
                                            [
                                                'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                                            ]
                                        );  ?>

                                        <?= $form->field($modelRequestMerchant, "[{$index}]governorate")->widget(
                                            Select2Widget::className(),
                                            [
                                                'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                                            ]
                                        ); ?>
                                        <?=  $form->field($modelRequestMerchant, "[{$index}]area")->widget(
                                            Select2Widget::className(),
                                            [
                                                'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                                            ]
                                        ); ?>

                                    </div>
                                    <div class="col-md-6">
                                        <?= $form->field($modelRequestMerchant, "[{$index}]number_of_houer")->textInput() ?>
                                        <?= $form->field($modelRequestMerchant, "[{$index}]desc_job")->textarea(['rows' => 6]) ?>
                                        <?= $form->field($modelRequestMerchant, "[{$index}]note")->textarea(['rows' => 6]) ?>
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
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>