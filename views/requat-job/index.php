<?php

use app\models\Area;
use app\models\Governorate;
use app\models\Nationality;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<script src="https://cdn.jsdelivr.net/npm/vue"></script>
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
                                    <div class="row">
                                        <div class="col-2 col-12-small">
                                            <label><?= Yii::t('app', 'Gender') ?> </label>
                                        </div>

                                        <div class="col-4 col-12-small">
                                            <input type="radio" id="radio-alpha" name="radio" value="1" checked>
                                            <label for="radio-alpha"> <?= Yii::t('app', 'Male') ?> </label>
                                        </div>
                                        <div class="col-4 col-12-small">
                                            <input type="radio" id="radio-beta" value="2" name="radio">
                                            <label for="radio-beta"><?= Yii::t('app', 'FeMale') ?></label>
                                        </div>
                                    </div>

                                </div>

                                <!-- Break -->
                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'agree')->textInput() ?>
                                </div>

                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'nationality')
                                        ->dropdownList(ArrayHelper::map(Nationality::find()->where(['!=', 'id', 1])->all(), 'id', 'name_ar'), ['class' => '']); ?>

                                </div>

                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'governorate')
                                        ->dropdownList(ArrayHelper::map(Governorate::find()->all(), 'id', 'name_ar'), ['class' => '']); ?>

                                </div>
                                <div class="col-3 col-12-xsmall">
                                    <?= $form->field($model, 'area')->textInput() ?>

                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <table class="table sqeqr">
                                        <thead>
                                            <tr class="float-left">
                                                <th scope="col">المسمى الوظيقي</th>
                                                <th scope="col">من</th>
                                                <th scope="col">الى</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="exp in count_experience">
                                                <td>
                                                    <input type=" text" class="form-control" name="jobs[]" />
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <select name="month-jobs[]">
                                                                <option v-for="item in 12">{{item }}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="year-jobs[]">
                                                                <option v-for="item in count">{{item +from_year}}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <select name="month-jobs[]">
                                                                <option v-for="item in 12">{{item}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="year-jobs[]">
                                                                <option v-for="item in count">{{item +from_year}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <tfoot>
                                            <tr>
                                                <td>
                                                    <span class="glyphicon glyphicon-plus" @click="add_experience" style="color:green"></span>
                                                    <span class="glyphicon glyphicon-minus" @click="remove_experience" style="color:red"></span>
                                                </td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        </tfoot>

                                        </tbody>
                                    </table>


                                </div>

                                <div class="col-6 col-12-xsmall">
                                    <?= $form->field($model, 'cv')->fileInput() ?>
                                </div>


                                <!-- Break -->
                                <div class="col-12 col-12-xsmall">
                                    <ul class="actions">
                                        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'primary']) ?>
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

<style>
    .sqeqr {
        border: 1px solid black;
        padding-top: 30px;

    }
</style>
<script>
    var d = new Date();
    var n = d.getFullYear();
    var count_m = n - 1992;
    let data = {
        message: 'Hello Vue!',
        year: n,
        from_year: 1992,
        count: count_m,
        count_experience: 1
    };
    var app = new Vue({
        el: '#app',
        data: data,
        methods: {
            add_experience() {
                if (this.count_experience) {
                    this.count_experience++;
                }
            },
            remove_experience() {
                if (this.count_experience) {
                    this.count_experience--;
                }
            }
        },
    });
</script>