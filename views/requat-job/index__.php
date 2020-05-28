<?php

use app\models\Governorate;
use app\models\Nationality;
use conquer\select2\Select2Widget;
use kartik\file\FileInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<div id="heading">
    <h1><?= Yii::t('app', 'Create_Requast_Job') ?></h1>
</div>


<!-- Main -->
<div id="app">

    <section id="main" class="wrapper">
        <div class="inner">
            <div class="content">

                <!-- Elements -->
                <div class="row">
                    <div class="col-12 col-12-medium">

                        <!-- Form -->

                        <h3><?= Yii::t('app', 'Create_Requast_Job') ?></h3>
                        <?php if (Yii::$app->session->has('message')) : ?>
                            <div class="alert alert-success" role="alert">
                                <h1><?php echo Yii::$app->session->get('message'); ?></h1>
                            </div>
                            <?php Yii::$app->session->remove('message'); ?>
                        <?php else : ?>


                            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                            <div class="row gtr-uniform">
                                <div class="col-4 col-12-xsmall">
                                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                                </div>
                                <div class="col-4 col-12-xsmall">
                                    <?= $form->field($model, 'phone')->textInput() ?>
                                </div>

                                <div class="col-4 col-12-xsmall">
                                    <?= $form->field($model, "gender")->dropDownList([1 => "ذكر", 2 => "انثى"]); ?>
                                </div>

                                <!-- Break -->
                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'phoagreene')->textInput() ?>
                                </div>

                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'nationality')->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Nationality::find()->all(), 'id', 'name_ar')
                                        ]
                                    ); ?>
                                </div>

                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'governorate')->widget(
                                        Select2Widget::className(),
                                        [
                                            'items' => ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar')
                                        ]
                                    ); ?>

                                </div>
                                <div class="col-3 col-12-xsmall">
                                    <label for="area"><?= Yii::t('app', "Area"); ?></label>
                                    <input type="text" v-model="form.area" id="area" class="form-control" />


                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h3><?= Yii::t('app', 'Educational_Attainment') ?></h3>

                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h3><?= Yii::t('app', 'Experience') ?></h3>


                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h3><?= Yii::t('app', 'Courses') ?></h3>



                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <?= $form->field($model, 'file')->widget(FileInput::classname(), [
                                        'options' => ['accept' => 'image/*'],
                                        'pluginOptions' => $dataAvatar
                                    ]);
                                    ?>
                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <?= $form->field($model, 'cv')->widget(FileInput::classname(), [
                                        'options' => ['accept' => 'image/*'],
                                        'pluginOptions' => $dataAvatar
                                    ]);
                                    ?>
                                </div>


                                <!-- Break -->
                                <div class="col-12 col-12-xsmall">
                                    <ul class="actions">
                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>

                                    </ul>
                                </div>
                            </div>
                            <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>


</div>

<?php endif; ?>