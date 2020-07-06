<?php

use app\models\User;
use Carbon\Carbon;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $user->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$dayes_of_week = [
    Yii::t('app', 'Saturday') => Yii::t('app', 'Saturday'),
    Yii::t('app', 'Sunday') => Yii::t('app', 'Sunday'),
    Yii::t('app', 'Monday') => Yii::t('app', 'Monday'),
    Yii::t('app', 'Tuesday') => Yii::t('app', 'Tuesday'),
    Yii::t('app', 'Wednesday') => Yii::t('app', 'Wednesday'),
    Yii::t('app', 'Thursday') => Yii::t('app', 'Thursday'),
    Yii::t('app', 'Friday') => Yii::t('app', 'Friday')
];

date_default_timezone_set('Asia/Amman');
$timestamp = date('H:i');
?>
<link href="<?= Yii::getAlias('@web') ?>/css/gijgo.min.css" rel="stylesheet" />
<script src="<?= Yii::getAlias('@web') ?>/js/gijgo.min.js">
</script>

<div class="">
    <div class="users"></div>

    <h3 id="marchent_id"></h3>
    <h3 id="user-name"><?= Html::encode($this->title) ?></h3>
    <div class="alert alert-success" id="success_message" style="display: none;" role="alert">
        succefully send message
    </div>
    <div class="alert alert-danger" id="error_message" style="display: none;" role="alert">
        error the messge not saved
    </div>

    <?php $form = ActiveForm::begin() ?>
    <div class="row">
        <!--            //class="glyphicon glyphicon-time"-->
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group">
                <p class="wrapper">
                    <label for="timepicker"><?= Yii::t('app', 'Time') ?></label>
                    <input id="timepicker" class="icon form-control" width="276" value="<?= $timestamp ?>" />
                </p>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">

            <?= $form->field($model, 'user_id')->widget(
                Select2Widget::classname(),
                [
                    'items' => $dayes_of_week,
                    'options' => [
                        'id' => 'day_metting'
                    ],
                ]
            )->label(Yii::t('app', 'Day')); ?>
        </div>

        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <div class="form-group">
                <a href="#" class="btn btn-primary" id="send-message"><?= Yii::t('app', 'Send') ?></a>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
            <div class="form-group">
                <button id="save-message" class="btn btn-primary float-right hidden"><?= Yii::t('app', 'Save') ?></button>
            </div>
        </div>


    </div>


    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col"><?= Yii::t('app', 'Priorities') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Area') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Experience') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Nationality') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Gender') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Coun_Send_Sms') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Agree') ?></th>
                        <th scope="col"> <?= Yii::t('app', 'Created_At') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Phone') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td id="priorities">
                            <?= $user->priorities    ?>
                        </td>

                        <td id="area-user">
                            <?= $user->area    ?>
                        </td>

                        <td id="experience-user">
                            <?= $user->experience    ?>
                        </td>
                        <td id="nationality-user">
                            <?= $user->nationality0->name_ar    ?>
                        </td>
                        <td id="gender-user">
                            <?php
                            if ($user->gender == User::MALE) {
                                echo "ذكر";
                            } elseif ($user->gender == User::FEMALE) {
                                # code...
                                echo "انثى";
                            } else {
                                echo 'غير محدد';
                            }
                            ?>
                        </td>
                        <td id="coun-send-sms-user">
                            <?= $user->smssend->count    ?>
                        </td>

                        <td id="agree-user">
                            <?= $user->agree    ?>
                        </td>
                        <td id="created-at-user">
                            <?php
                            $now = Carbon::now("Asia/Amman");
                            $date = Carbon::parse(Carbon::parse($user->created_at));
                            $def = $date->diffInDays($now);
                            echo  "سجلت قبل " . $def . " يوم";
                            ?>
                        </td>
                        <td id="phone-user">
                            <?= $user->phone    ?>
                        </td>

                    </tr>
                </tbody>
            </table>
        </div>
    </div>


    <div class="message" message="<?= $message ?>"></div>

    <div id="phone-for" phone="<?= $user->phone ?>"></div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'user_id')->widget(
                Select2Widget::classname(),
                [
                    'items' => ArrayHelper::map(User::find()->where(['type' => User::FORM_APPLAY_USER])
                        ->orWhere(['type' => User::NORMAL_USER])->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Select Phone Number', 'value' => $user->id, 'id' => 'user-id'],
                ]
            )->label(Yii::t('app', 'Name'));
            ?>


        </div>
        <div class="col-md-8">
            <?= $form->field($model, 'text')->textarea(['maxlength' => true, 'id' => 'message-text'])->label(Yii::t('app', 'Text')); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col"><?= Yii::t('app', 'Name_Merchant') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Area') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Job_Title') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Desc_Job') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Phone') ?></th>
                        <th scope="col"><?= Yii::t('app', 'Created_At') ?></th>
                    </tr>
                </thead>
                <tbody class="suggesstion-box">
                </tbody>
            </table>


        </div>

    </div>


    <?php ActiveForm::end(); ?>

</div>
</div>
</div>
<script>
    $('#timepicker').timepicker();
</script>