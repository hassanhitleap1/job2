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

$this->title = Yii::t('app', 'Requast_Job');

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
            <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'options' => ['enctype' => 'multipart/form-data']]); ?>
            <div class="panel-body">

                <div class="row">
                    <div class="col-lg-2">
                        <?= $form->field($model, 'name')->textInput(['maxlength' => true])
                            ->label(Yii::t('app', 'Name_full') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Name_Example') . '"></span>') ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"]); ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'agree')->textInput()->label(Yii::t('app', 'Agree') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Agree_Example') . '"></span>')  ?>
                    </div>
                    <div class="col-lg-2">
                        <?= $form->field($model, 'nationality')->widget(
                            Select2Widget::className(),
                            [
                                'items' => ArrayHelper::map(Nationality::find()->where(['<>', 'id', 1])->all(), 'id', 'name_ar')
                            ]
                        ); ?>
                    </div>
                    <div class="col-md-2">
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
                                'items' => ArrayHelper::map(Area::find()->where(['<>', 'id', 1])->all(), 'id', 'name_ar')
                            ]
                        ); ?>
                    </div>
                    <div class="col-md-2">
                        <?= $form->field($model, "year_of_experience")->textInput()
                            ->label(Yii::t('app', 'Year_Of_Experience') . '  <span type="button" class=" tooltip-helper glyphicon glyphicon-info-sign" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="' . Yii::t('app', 'Year_Of_Experience_Example') . '"></span>'); ?>
                    </div>
                </div>
                <div class="row">
                    <?php include('edu_att.php') ?>
                </div>
                <div class="row">
                    <?php include('experience.php') ?>
                </div>
                <div class="row">
                    <?php include('courses.php') ?>
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