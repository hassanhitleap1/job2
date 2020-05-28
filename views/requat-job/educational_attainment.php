<?php use wbraganca\dynamicform\DynamicFormWidget;?>
<div class="col-12 col-12-xsmall">
    <h3><?= Yii::t('app', 'Educational_Attainment') ?></h3>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3><i class="glyphicon glyphicon-education"></i>
                <?= Yii::t('app', 'Educational_Attainment') ?>
            </h3>
        </div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper_educational_attainment', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
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
                <?php foreach ($modelsEducationalAttainment as $index => $modelEducaAtta) : ?>
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
                            if (!$modelEducaAtta->isNewRecord) {
                                echo Html::activeHiddenInput($modelEducaAtta, "[{$index}]id");
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($modelEducaAtta, "[{$index}]specialization")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-3">
                                    <?= $form->field($modelEducaAtta, "[{$index}]university")->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-md-2">
                                    <?= $form->field($modelEducaAtta, "[{$index}]year_get")->textInput(['maxlength' => true]) ?>
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


