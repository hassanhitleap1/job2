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
                                                <select class="form-control" v-model="degrees[academic_achie]">
                                                    <option v-for="(degree,index) in data.degree" :key="index" :value="index"  >{{ degree  }}</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type=" text" class="form-control" v-model="specialization[academic_achie]"/>
                                            </td>
                                            <td>
                                                <input type=" text" class="form-control" v-model="the_college_universitys[academic_achie]" />
                                            </td>
                                            <td>
                                                <select v-model="year_academic_achievement[academic_achie]" class="form-control">
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
                                                    <input type=" text" class="form-control" v-model="job_title[exp]"/>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <select  v-model="month_from_exp[exp]" class="form-control">
                                                                <option v-for="item in 12">{{item }}</option>
                                                            </select>
                                                            <select v-model="year_from_exp[exp]" class="form-control">
                                                                <option v-for="item in count">{{item +from_year}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select  v-model="month_to_exp[exp]" class="form-control">
                                                                <option v-for="item in 12">{{item }}</option>
                                                            </select>
                                                            <select v-model="year_to_exp[exp]" class="form-control">
                                                                <option v-for="item in count">{{item +from_year}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type=" text" class="form-control" v-model="facility_name[exp]" />
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
                                                <input type=" text" class="form-control" v-model="name_courses[count_co]"/>
                                            </td>

                                            <td>
                                                <input type=" text" class="form-control" v-model="destinations[count_co]" />
                                            </td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <select  v-model="month_from_course[count_co]" class="form-control">
                                                            <option v-for="item in 12">{{item }}</option>
                                                        </select>
                                                        <select v-model="year_from_course[count_co]" class="form-control">
                                                            <option v-for="item in count">{{item +from_year}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select  v-model="month_to_course[count_co]" class="form-control">
                                                            <option v-for="item in 12">{{item }}</option>
                                                        </select>
                                                        <select v-model="year_to_course[count_co]" class="form-control">
                                                            <option v-for="item in count">{{item +from_year}}</option>
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
    <button class="btn btn-success" @click="submitform">ssssssss</button>

</div>

<?php endif; ?>

