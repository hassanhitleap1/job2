<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'CV');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="cv-print">
    
    <div class="row">
        <div class="name-cv col-lg-4 col-md-4 col-offset-3">
            <?= Html::img('@web/images/logo.svg', ['class' => 'logo ']) ?>
            <h3> جرس لوساطة التوظيف : السيرة الذاتية </h3>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6 info-profile">
            <h3>معلومات الشخصية :</h3>
            <ul style="font-size: 20px;">
                <li> الاسم :- <?= $model->name ?></li>
                <li> هاتف :- <?= $model->phone ?> </li>
                <li> العمر:- <?= $model->agree ?> سنين </li>
                <li> الجنسية :- <?= $model->nationality0->name_ar ?> </li>
            </ul>
        </div>
        <div class="vl"></div>

        <?php if ($model->avatar != "" || $model->avatar != null) : ?>
        <div class="col-md-6">
            <?= Html::img($model->avatar, ['class' => 'image-profile-cv']); ?>
        </div>
        <?php endif; ?>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-12">
            <h3> الشهادات :</h3>
            <p style="font-size: 20px;">
                <?= $model->certificates ?>
            </p>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h3> الخبرات :</h3>
            <p style="font-size: 20px;">
                <?= $model->experience ?>
            </p>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <p>
               الموظف الذي يحمل هذه السيره الذاتية يرجى التوصيه به بنأ على الوصف والمواصفات الوظيفية

            </p>
        </div>
    </div>





</div>

<div class="container">
    <div class="row">
        <button class="btn btn-primary btn-lg" id="btn-print-cv"><?= Yii::t('app', 'Print_CV') ?></button>
    </div>
</div>