<?php

use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap\Html;

?>
<div class="panel panel-default">
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
                'name_course',
                'destination',
                'duration',
            ],
        ]); ?>

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <?= Yii::t('app', 'Courses') ?> <?= Yii::t('app', 'IF_Exist') ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <!-- widgetContainer -->
                <?php foreach ($modelsCourses as $index => $modelCourse) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address"> <?= Yii::t('app', 'Courses') ?> : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">
                            <?php
                            // necessary for update action.
                            if (!$modelCourse->isNewRecord) {
                                echo Html::activeHiddenInput($modelCourse, "[{$index}]id");
                            }
                            ?>

                            <div class="row">
                                <div class="col-sm-4">
                                    <?= $form->field($modelCourse, "[{$index}]name_course")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Name_Course') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Name_Course_Example') . '"></span>') ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelCourse, "[{$index}]destination")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Destination') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Destination_Example') . '"></span>')  ?>
                                </div>
                                <div class="col-sm-4">
                                    <?= $form->field($modelCourse, "[{$index}]duration")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Duration') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Duration_Example') . '"></span>')  ?>
                                </div>
                            </div><!-- end:row -->  


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

jQuery(".dynamicform_wrapper_courses").on("afterInsert", function(e, item) {
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Courses') . ': " + (index + 1))
});
});

jQuery(".dynamicform_wrapper_courses").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper_courses .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Courses') . ': " + (index - 1))
});
});
';

$this->registerJs($js);
?>