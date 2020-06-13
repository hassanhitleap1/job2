<?php

use app\models\Degrees;
use conquer\select2\Select2Widget;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$year = array_combine(range(1990, date("Y")), range(1990, date("Y")));

?>
<div class="panel panel-default">
    <div class="panel-body">
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper_edu', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 8, // the maximum times, an element can be cloned (default 999)
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

        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="fa fa-envelope"></i> <?= Yii::t('app', 'Educational_Attainment') ?>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body container-items">
                <!-- widgetContainer -->
                <?php foreach ($modelsEducationalAttainment as $index => $modelEduAt) : ?>
                    <div class="item panel panel-default">
                        <!-- widgetBody -->
                        <div class="panel-heading">
                            <span class="panel-title-address"> <?= Yii::t('app', 'Educational_Attainment') ?> : <?= ($index + 1) ?></span>
                            <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
                                <div class="col-sm-3">
                                    <?= $form->field($modelEduAt, "[{$index}]degree")->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Degrees::find()->all(), 'name', 'name')
                                        ]
                                    ); ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelEduAt, "[{$index}]specialization")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'Specialization') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Specialization_Example') . '"></span>') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelEduAt, "[{$index}]university")->textInput(['maxlength' => true])
                                        ->label(Yii::t('app', 'University') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'University_Example') . '"></span>') ?>
                                </div>
                                <div class="col-sm-3">
                                    <?= $form->field($modelEduAt, "[{$index}]year_get")->dropDownList($year, ['prompt' => Yii::t('app', 'Plz_Select_Year')]) ?>
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

jQuery(".dynamicform_wrapper_edu").on("afterInsert", function(e, item) {
   
jQuery(".dynamicform_wrapper_edu .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Educational_Attainment') . ': " + (index + 1))
});
});

jQuery(".dynamicform_wrapper_edu").on("afterDelete", function(e) {
jQuery(".dynamicform_wrapper_edu .panel-title-address").each(function(index) {
jQuery(this).html("' . Yii::t('app', 'Educational_Attainment') . ': " + (index - 1))
});
});


';

$this->registerJs($js);
?>