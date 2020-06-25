<?php

use app\models\RequastJobForm;
use app\models\User;
use app\models\UserMessageClarification;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$dataModel = UserMessageClarification::find()->where(['user_id' => Yii::$app->user->id])->one();
 $message = ($dataModel == null) ? '' : $dataModel->text;
$path = Yii::getAlias('@webroot') . '/' . Yii::$app->user->identity->contract_path;
$path_web = Yii::getAlias('@web') . '/' . Yii::$app->user->identity->contract_path;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?php $phone = substr($model->phone, 1); ?>
        <?= Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank', 'class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]); ?>
        <button class="btn btn-info"> الرسائل<span class="massges"> <?= $model->smssend->count ?></span></button>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::NOT_INTERVIEWED ?> <?= (RequastJobForm::NOT_INTERVIEWED == $model->action_user) ? 'checked' : '' ?>> <?= Yii::t('app', 'NOT_INTERVIEWED') ?></label>
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::WAS_INTERVIEWED ?> <?= (RequastJobForm::WAS_INTERVIEWED == $model->action_user) ? 'checked' : '' ?>><?= Yii::t('app', 'WAS_INTERVIEWED') ?></label>
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::IGNORAE ?> <?= (RequastJobForm::IGNORAE == $model->action_user) ? 'checked' : '' ?>><?= Yii::t('app', 'IGNORAE') ?></label>
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::BUSY ?> <?= (RequastJobForm::BUSY == $model->action_user) ? 'checked' : '' ?>><?= Yii::t('app', 'BUSY') ?></label>
        </div>


    </p>

    <div class="row">
        <div class="col-md-2">
            <?= Yii::t('app', 'Name') . ' :-' ?>
            <?= $model->name ?>
        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Agree') . ' :-' ?>
            <?= $model->agree ?>
        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Gender') . ' :-' ?>
            <?= ($model->gender == User::MALE) ? "ذكر" : ($model->gender == User::FEMALE) ? "انثى" : 'غير محدد' ?>

        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Phone') . ' :-' ?>
            <?= $model->phone ?>
        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Email') . ' :-' ?>
            <?= $model->email ?>
        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Governorate') . ' :-' ?>
            <?= $model->governorate0['name_ar'] ?>
        </div>
        <div class="col-md-2">
            <?= Yii::t('app', 'Area') . ' :-' ?>
            <?= $model->area0['name_ar'] ?>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-3">
            <?= Yii::t('app', 'Year_Of_Experience') . ' :-' ?>
            <?= $model->year_of_experience ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Experience') . ' :-' ?>
            <?= $model->experience ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Certificates') . ' :-' ?>
            <?= $model->certificates ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Courses') . ' :-' ?>
            <?= $model->priorities ?>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-3">
            <?= Yii::t('app', 'Affiliated_To') . ' :-' ?>
            <?= $model->affiliated_to ?>
        </div>

        <div class="col-md-3">
            <?= Yii::t('app', 'Affiliated_With') . ' :-' ?>
            <?= $model->affiliated_with ?>
        </div>


        <div class="col-md-3">
            <?= Yii::t('app', 'Expected_Salary') . ' :-' ?>
            <?= $model->expected_salary ?>
        </div>




        <div class="col-md-3">
            <?= Yii::t('app', 'Interview_Time') . ' :-' ?>
            <?= $model->interview_time ?>
        </div>


        <div class="col-md-3">
            <?= Yii::t('app', 'Teamwork') . ' :-' ?>
            <?= $model->teamwork ?>
        </div>

        <div class="col-md-3">
            <?= Yii::t('app', 'Work_Permanently') . ' :-' ?>
            <?= $model->work_permanently ?>
        </div>

        <div class="col-md-3">
            <?= Yii::t('app', 'Communication_Skills') . ' :-' ?>
            <?= $model->communication_skills ?>
        </div>


    </div>
    <hr />
    <div class="row">

        <div class="col-md-3">
            <?= Yii::t('app', 'Note') . ' :-' ?>
            <?= $model->note ?>
        </div>

        <div class="col-md-3">
            <?= Yii::t('app', 'First_Payment') . ' :-' ?>
            <?= $model->first_payment ?>
        </div>
    </div>
    <hr />
    <?php if(file_exists($path)):?>
        <?= Html::img($path_web, ['class' => "img-rounded img-responsive center-block",'style'=>['width'=>'200px','hight'=>'200px']]); ?>
    <?php endif;?>
</div>

