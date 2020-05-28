<?php use wbraganca\dynamicform\DynamicFormWidget;?>
<div class="col-12 col-12-xsmall">
    <h3><?= Yii::t('app', 'Courses') ?></h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><i class="glyphicon glyphicon-education"></i>
                <?= Yii::t('app', 'Courses') ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_courses', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsCourses[0],
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
            <div class="container-items">
                <!-- widgetContainer -->
                <?php foreach ($modelsCourses as $index => $modelCourse) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <h3 class="panel-title pull-left"><?= Yii::t('app', 'Educational_Attainment') . " {" . ($index + 1) . "}" ?> </h3>
                            <div class="pull-right">
                                <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            if (!$modelCourse->isNewRecord) {
                                echo Html::activeHiddenInput($modelCourse, "[{$index}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($modelCourse, "[{$index}]name_course")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelCourse, "[{$index}]destination")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelCourse, "[{$index}]duration")->textInput(['maxlength' => true]) ?>
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

<?php

$js = '

jQuery(".dynamicform_wrapper_courses").on("afterInsert", function(e, item) {
   
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
jQuery(this).html("Address: " + (index + 1))
});
});

jQuery(".dynamicform_wrapper_courses").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
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

