<?php

use yii\helpers\Html;


$this->title = Yii::t('app', 'CV');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container" id="cv-print">
    <div class="row">
        <div class="name-cv col-lg-4 col-md-4 col-offset-3">
            <h2> السيرة الذاتية</h2>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-6 info-profile">
            <h2>معلومات الشخصية :</h2>
            <ul style="font-size: 20px;">
                <li> الاسم :- <?= $model->name ?></li>
                <li> هاتف :- <?= $model->phone ?> </li>
                <li> العمر:- <?= $model->agree ?> سنين </li>
                <li> الجنسية :- <?= $model->nationality0->name_ar ?> </li>
            </ul>
        </div>
        <div class="col-md-6">
            <?= Html::img('images/profile.png', ['class' => 'image-profile-cv']); ?>
        </div>
    </div>
    <hr />

    <div class="row">
        <div class="col-md-12">
            <h2> الشهادات :</h2>
            <p style="font-size: 20px;">
                <?= $model->certificates ?>
            </p>
        </div>
    </div>
    <hr />
    <div class="row">
        <div class="col-md-12">
            <h2> الخبرات :</h2>
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