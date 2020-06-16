<?php

use app\models\RequastJobForm;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php $phone = substr($model->phone, 1); ?>
        <?= Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=شكرا لتعاملكم مع جرس للخدمات الوجستية نود اعلامكم عن توفر وظيفة    '     '  لدى مؤسسة للاستفسار الاتصال على الرقم التالي", ['target' => '_blank', 'class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]); ?>
        <button class="btn btn-info"> الرسائل<span class="massges"> <?= $model->smssend->count ?></span></button>
        <div class="form-group">
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::NOT_INTERVIEWED ?> <?= (RequastJobForm::NOT_INTERVIEWED == $model->action_user) ? 'checked' : '' ?>> <?= Yii::t('app', 'NOT_INTERVIEWED') ?></label>
            <label class="radio-inline"><input type="radio" name="action_user" id_data=<?= $model->id ?> value=<?= RequastJobForm::WAS_INTERVIEWED ?> <?= (RequastJobForm::WAS_INTERVIEWED == $model->action_user) ? 'checked' : '' ?>><?= Yii::t('app', 'WAS_INTERVIEWED') ?></label>
        </div>


    </p>

    <div class="row">
        <div class="col-md-3">
            <?= Yii::t('app', 'Name') . ' :-' ?>
            <?= $model->name ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Agree') . ' :-' ?>
            <?= $model->agree ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Phone') . ' :-' ?>
            <?= $model->phone ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Governorate') . ' :-' ?>
            <?= $model->governorate0['name_ar'] ?>
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
            <?= Yii::t('app', 'First_Payment') . ' :-' ?>
            <?= $model->first_payment ?>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-3">
            <?= Yii::t('app', 'Gender') . ' :-' ?>
            <?= ($model->gender == User::MALE) ? "ذكر" : ($model->gender == User::FEMALE) ? "انثى" : 'غير محدد' ?>

        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Note') . ' :-' ?>
            <?= $model->note ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'Priorities') . ' :-' ?>
            <?= $model->priorities ?>
        </div>
        <div class="col-md-3">
            <?= Yii::t('app', 'First_Payment') . ' :-' ?>
            <?= $model->first_payment ?>
        </div>
    </div>
</div>



<?php
$script = <<< JS

$(document).on("click", "input[type=radio][name=action_user]", function (e) {
    var url = "/index.php?r=requast-job-form/change-action&id=" + $(this).attr("id_data");
    data={
        "action_user":$(this).val(),
    }
    $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function (response) {
          alert("success"); 
        }
    });
});

JS;
$this->registerJs($script);
?>