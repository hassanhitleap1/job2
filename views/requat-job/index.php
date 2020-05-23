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
                                    <h3><?= Yii::t('app','Educational_Attainment')?></h3>
                                    <table class="table sqeqr">
                                        <thead >
                                        <tr>
                                            <th>
                                                <div class="float-right"><?=Yii::t('app','Degree')?></div>
                                            </th>
                                            <th >
                                                <div class="float-right"><?= Yii::t('app','Specialization')?></div>
                                            </th>
                                            <th >
                                                <div class="float-right"><?= Yii::t('app','The_College_University')?></div>
                                            </th>
                                            <th >
                                                <div class="float-right"><?= Yii::t('app','Year_Of_Acquiring_It')?></div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="academic_achie in count_academic_achievement">
                                            <td>
                                                <select class="form-control">
                                                    <option v-for="degree in data.degree">{{degree }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type=" text" class="form-control" name="jobs[]" />
                                            </td>
                                            <td>
                                                <input type=" text" class="form-control" name="jobs[]" />
                                            </td>
                                            <td>
                                                <select name="year-jobs[]" class="form-control">
                                                    <option v-for="item in count">{{item +from_year}}</option>
                                                </select>
                                            </td>

                                        </tr>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-plus" @click="add_academic_achievement" style="color:green"></span>
                                                <span class="glyphicon glyphicon-minus" @click="remove_academic_achievement" style="color:red"></span>
                                            </td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        </tfoot>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-12 col-12-xsmall">
                                    <h3><?= Yii::t('app','Experience')?></h3>
                                    <table class="table sqeqr">
                                        <thead>
                                            <tr class="float-left">
                                                <th>
                                                    <div class="float-right"> <?= Yii::t('app','Job_Title')?></div>
                                                </th>
                                                <th scope="col">
                                                    <div class="float-right"><?= Yii::t('app','Time_Period')?> </div>
                                                </th>

                                                <th scope="col">ا
                                                    <div class="float-right"><?= Yii::t('app','Facility_Name')?></div>
                                                </th>

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
                                                            <select name="month-jobs[]" class="form-control">
                                                                <option v-for="item in 12">{{item }}</option>
                                                            </select>
                                                            <select name="month-jobs[]" class="form-control">
                                                                <option v-for="item in 12">{{item}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select name="month-jobs[]" class="form-control">
                                                                <option v-for="item in 12">{{item }}</option>
                                                            </select>
                                                            <select name="month-jobs[]" class="form-control">
                                                                <option v-for="item in 12">{{item}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type=" text" class="form-control" name="jobs[]" />
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

                                <div class="col-12 col-12-xsmall">
                                    <h3><?= Yii::t('app','Courses')?></h3>
                                    <table class="table sqeqr">
                                        <thead>
                                        <tr class="float-left">
                                            <th scope="col">
                                                <div class="float-right"><?= Yii::t('app','The_Name_Of_The_Course')?></div>
                                            </th>
                                            <th scope="col">
                                                <div class="float-right"> <?= Yii::t('app','The_Destination')?></div>
                                            </th>
                                            <th scope="col">
                                                <div class="float-right"><?= Yii::t('app','Time_Period')?></div>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="count_co in count_courses">
                                            <td>
                                                <input type=" text" class="form-control" name="jobs[]" />
                                            </td>

                                            <td>
                                                <input type=" text" class="form-control" name="jobs[]" />
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="month-jobs[]" class="form-control">
                                                            <option v-for="item in 12">{{item }}</option>
                                                        </select>
                                                        <select name="month-jobs[]" class="form-control">
                                                            <option v-for="item in 12">{{item}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select name="month-jobs[]" class="form-control">
                                                            <option v-for="item in 12">{{item }}</option>
                                                        </select>
                                                        <select name="month-jobs[]" class="form-control">
                                                            <option v-for="item in 12">{{item}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tfoot>
                                        <tr>
                                            <td>
                                                <span class="glyphicon glyphicon-plus" @click="add_courses" style="color:green"></span>
                                                <span class="glyphicon glyphicon-minus" @click="remove_courses" style="color:red"></span>
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
    .float-right{
        float: right !important;
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
        count_experience: 1,
        count_academic_achievement:1,
        count_courses:1,
        degree:["باكالوريا","وبلوم","دكتوراه","اعدادي","ثانوي","اساسي"]
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
            },
            add_academic_achievement() {
                if (this.count_academic_achievement) {
                    this.count_academic_achievement++;
                }
            },
            remove_academic_achievement() {
                if (this.count_academic_achievement) {
                    this.count_academic_achievement--;
                }
            },
            add_courses(){
                if (this.count_courses) {
                    this.count_courses++;
                }
            },
            remove_courses(){
                if (this.count_courses) {
                    this.count_courses--;
                }
            }
        },
    });
</script>