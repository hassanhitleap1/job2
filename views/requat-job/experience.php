<?php

use Carbon\Carbon;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;
use kartik\date\DatePicker;

$month = range(1, 12);
$year = range(1990, date("Y"));
$pluginOptions = [];

?>

<div class="panel panel-default">
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper_experience', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 4, // the maximum times, an element can be cloned (default 999)
            'min' => 1, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsExperiences[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'job_title',
                'month_from_exp',
                'year_from_exp',
                'month_to_exp',
                'year_to_exp',
                'facility_name'
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <?= Yii::t('app', 'Experience') ?> <?= Yii::t('app', 'IF_Exist') ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <!-- widgetContainer -->
                <?php foreach ($modelsExperiences as $index => $modelsExperience) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address"> <?= Yii::t('app', 'Experience') ?> : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>

                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelsExperience->isNewRecord) {
                                echo Html::activeHiddenInput($modelsExperience, "[{$index}]id");
                            }
                            ?>

                            <div class="row">


                                <div class="col-md-3">
                                    <?= $form->field($modelsExperience, "[{$index}]job_title")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Job_Title') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Job_Title_Example') . '"></span>')  ?>
                                </div>
                                <div class="col-md-3">

                                    <?= $form->field($modelsExperience, "[{$index}]date_from")->widget(\yii\jui\DatePicker::classname(), [
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'options' => [
                                            'class' => 'form-control'
                                        ]
                                    ]) ?>

                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelsExperience, "[{$index}]date_to")->widget(\yii\jui\DatePicker::classname(), [
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                      'options' => [
                                                'class' => 'form-control'
                                            ]
                                        
                                    ]) ?>

                                

                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelsExperience, "[{$index}]facility_name")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Facility_Name') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Facility_Name_Example') . '"></span>')  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php DynamicFormWidget::end(); ?>
    </div>
</div>




<?php

$js = '

jQuery(".dynamicform_wrapper_experience").on("afterInsert", function(e, item) {
   
jQuery(".dynamicform_wrapper_experience .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Experience') . ': " + (index + 1))
jsRunDateTime(index+1);
});
});

jQuery(".dynamicform_wrapper_experience").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper_experience .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Experience') . ': " + (index - 1));
});
});


function jsRunDateTime(index) {
    var selector="#experiences-"+index+"-date_from";
    $(selector).datepicker();
}
   


';
//jQuery("#experiences-"+index+"-date_from").datepicker());
$this->registerJs($js);


?>