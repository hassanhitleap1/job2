<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'CV');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="cv-print">
    <div class="row">
        <div class="name-cv col-lg-4 col-md-4 col-offset-3">
            <h1> السيرة الذاتية</h1>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6 info-profile">
            <h1>معلومات الشخصية :</h1>
            <dl class="dl-horizontal" style="font-size: 20px;">
                <dt> الاسم :- </dt>
                <dd> <?= $model->name ?></dd>
                <dt> هاتف :- </dt>
                <dd> <?= $model->phone ?></dd>
                <dt> العمر :- </dt>
                <dd> <?= $model->agree ?> سنين</dd>
                <dt> الجنسية :- </dt>
                <dd> <?= $model->nationality0->name_ar ?></dd>
            </dl>
        </div>
        <div class="col-md-6">
            <?= Html::img('images/profile.png', ['class' => 'image-profile-cv']); ?>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-12">
            <h1> الشهادات :</h1>
            <p style="font-size: 20px;">
                <?= $model->certificates ?>
            </p>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h1> الخبرات :</h1>
            <p style="font-size: 20px;">
                <?= $model->experience ?>
            </p>
        </div>
    </div>





</div>

<div class="container">
    <div class="row">
        <button class="btn btn-primary btn-lg" id="btn-print-cv"><?= Yii::t('app', 'Print_CV') ?></button>
    </div>
</div>