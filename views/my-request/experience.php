<?php

use app\models\NameOfJobs;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;

$month = range(1, 12);
$year = range(1990, date("Y"));
$yearRange = '1970:' . date("Y");
$jobsName = ArrayHelper::getColumn(NameOfJobs::find()->all(), 'name_ar');
$jobsName = Json::encode($jobsName);
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
                                    <?= $form->field($modelsExperience, "[{$index}]job_title")->textInput(['maxlength' => true, 'class' => 'form-control job_title_aut_com']) //
                                        ->label(Yii::t('app', 'Job_Title') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Job_Title_Example') . '"></span>')  ?>
                                </div>
                                <div class="col-md-3">

                                    <?= $form->field($modelsExperience, "[{$index}]date_from")->widget(\yii\jui\DatePicker::classname(), [
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'clientOptions' => [
                                            'changeYear' => true,
                                            'changeMonth' => true,
                                            'changeDay' => true,
                                            'yearRange' => $yearRange,
                                        ],
                                        'options' => [
                                            'class' => 'form-control',
                                            'autocomplete' => "off",
                                        ]
                                    ]) ?>

                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelsExperience, "[{$index}]date_to")->widget(\yii\jui\DatePicker::classname(), [
                                        //'language' => 'ru',
                                        'dateFormat' => 'yyyy-MM-dd',
                                        'clientOptions' => [
                                            'changeYear' => true,
                                            'changeMonth' => true,
                                            'changeDay' => true,
                                            'yearRange' => $yearRange,
                                        ],
                                        'options' => [
                                            'class' => 'form-control',
                                            'autocomplete' => "off",
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
<script type="text/javascript">
    var jobsName = <?= $jobsName ?>;
</script>
<?php

$js = '

jQuery(".dynamicform_wrapper_experience").on("afterInsert", function(e, item) {
   
jQuery(".dynamicform_wrapper_experience .panel-title-address").each(function(index) {
    jQuery(this).html("' . Yii::t('app', 'Experience') . ': " + (index + 1))
        jsRunDateTime(index+1);
            $( ".job_title_aut_com" ).autocomplete({
              source: jobsName
            });
    });
});

jQuery(".dynamicform_wrapper_experience").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper_experience .panel-title-address").each(function(index) {
        jQuery(this).html("' . Yii::t('app', 'Experience') . ': " + (index - 1));
    });
});


function jsRunDateTime(index) {
    let current_datetime = new Date()
    let formatted_date = current_datetime.getFullYear() + "-" + (current_datetime.getMonth() + 1) + "-" + current_datetime.getDate();
    let yearRange="1970:"+current_datetime.getFullYear() ;
    var selector_date_from="#experiences-"+index+"-date_from";
     var selector_date_to="#experiences-"+index+"-date_to";
    $(selector_date_to).datepicker({ dateFormat: "yy-mm-dd", changeYear : true,changeMonth : true,changeDay : true ,yearRange: yearRange,defaultDate:formatted_date });
    $(selector_date_from).datepicker({ dateFormat: "yy-mm-dd", changeYear : true,changeMonth : true,changeDay : true,yearRange: yearRange, defaultDate:formatted_date});
}

$(function(){
     $( ".job_title_aut_com" ).autocomplete({
      source: jobsName
    });
   
 });
 
function autoCom(){
   $( ".job_title_aut_com" ).autocomplete({
      source: jobsName
    });
}

';

$this->registerJs($js);


?>