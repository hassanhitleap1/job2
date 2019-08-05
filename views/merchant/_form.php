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
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsRequestMerchant[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'job_title',
                'desc_job',
                'salary_from',
                'salary_to',
                'agree_from',
                'agree_to',
                'governorate',
                'area',
                'number_of_houer',
                'nationality',
                'note',

            ],
        ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> requast marchent
                <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Add address</button>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <!-- widgetContainer -->
                <?php foreach ($modelsRequestMerchant as $index => $modelsRequestMerchant) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address">Address: <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelsRequestMerchant->isNewRecord) {
                                echo Html::activeHiddenInput($modelsRequestMerchant, "[{$index}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]job_title")->textInput(['maxlength' => true]) ?>

                                    <?= $form->field($modelsRequestMerchant, "[{$index}]salary_from")->textInput() ?>

                                    <?= $form->field($modelsRequestMerchant, "[{$index}]salary_to")->textInput() ?>

                                    <?= $form->field($modelsRequestMerchant, "[{$index}]agree_from")->textInput() ?>

                                    <?= $form->field($modelsRequestMerchant, "[{$index}]agree_to")->textInput() ?>
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]nationality")->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                                        ]
                                    ); ?>

                                    <?= $form->field($modelsRequestMerchant, "[{$index}]governorate")->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                                        ]
                                    ); ?>
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]area")->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Area::find()->all(), 'name_ar', 'name_ar')
                                        ]
                                    ); ?>

                                </div>
                                <div class="col-md-6">
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]number_of_houer")->textInput() ?>
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]desc_job")->textarea(['rows' => 6]) ?>
                                    <?= $form->field($modelsRequestMerchant, "[{$index}]note")->textarea(['rows' => 6]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>


    </div>
    <div class="row">
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
</div>