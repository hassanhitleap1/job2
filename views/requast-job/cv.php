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
        <div class="col-md-5">
           
            <div class="row">
                <div class="col-md-12">
                    <?= Html::img('@web/images/profile.png', ['class' => 'image-profile-cv']) ?>
                </div>    
            </div>
            <hr>
            <div class="row info-profile">
                <div class="cal-md-12">
                    <h3>معلومات الشخصية :</h3>
                    <ul style="font-size: 20px;">
                        <li> هاتف :- <?= $model->phone ?> </li>
                        <li> العمر:- <?= $model->agree ?> سنين </li>
                        <li> الجنسية :- <?= $model->nationality0->name_ar ?> </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row info-profile">
                <div class="cal-md-12">
                    <h3>المهارات الشخصية  :</h3>
                    <div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-custum" role="progressbar" aria-valuenow="98"
                            aria-valuemin="0" aria-valuemax="100" style="width: 98%;" >
                                    98% قدره تحمل العمل 
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-custum" role="progressbar" aria-valuenow="97"
                            aria-valuemin="0" aria-valuemax="100"  style="width: 97%;">
                                97% العمل بروح الفريق
                            </div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-custum" role="progressbar" aria-valuenow="100"
                            aria-valuemin="0" aria-valuemax="100" style="width: 95%;">
                                 95% الالتزام الرسمي بالدوام 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  
        <div class="vl"></div>
        <div class="col-md-7 row2">
            <div class="row">
                    <div class="panel card-name">
                        <div class="panel-heading">
                            <h2>
                            الاسم :- <?= $model->name ?>
                            <h2>
                        </div>
                    </div>   
            </div>
            <hr>
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

</div>

<div class="container">
    <div class="row">
        <button class="btn btn-primary btn-lg" id="btn-print-cv"><?= Yii::t('app', 'Print_CV') ?></button>
    </div>
</div>