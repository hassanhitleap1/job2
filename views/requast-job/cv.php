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
        <div class="col-md-5 column-info">
           
            <div class="row">
                <div class="col-md-12">
                    <?php if($model->avatar==null) :?>
                            <?= Html::img('@web/images/profile.png', ['class' => 'image-profile-cv']) ?>
                    <?php else:?>
                            <?= Html::img("@web/$model->avatar", ['class' => 'image-profile-cv']) ?>
                    <?php endif;?>
                </div>    
            </div>
            <div class="row info-profile">
                
                <h3><span class="glyphicon glyphicon-user"> </span> معلومات الشخصية :</h3>
               
                <hr>
                <div class="cal-md-12">
                    
                    <ul style="font-size: 20px;">
                        <li> هاتف :- <?= $model->phone ?> </li>
                        <li> العمر:- <?= $model->agree ?> سنين </li>
                        <li> الجنسية :- <?= $model->nationality0->name_ar ?> </li>
                        <li> الجنس :- <?= ($model->gender == 1)? 'ذكر' : ($model->gender==2) ? 'انثى' :'غير محدد';?> </li>
                    </ul>
                </div>
            </div>
            <hr>
            <div class="row info-profile">
            <h3><span class="glyphicon glyphicon-stats"> </span> المهارات الشخصية  :</h3>
                
                <div class="cal-md-12">
                  
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
            
            <div class="row">
                    <h3><span class="glyphicon glyphicon-wrench blue-h"></span><strong class="blue-h"> الشهادات :</strong></h3>
                    <hr>
                    <div class="col-md-12">
                        
                        <p style="font-size: 20px;">
                            <?= $model->certificates ?>
                        </p>
                    </div>
            </div>
            <hr />
        <div class="row">
            <h3><span class="glyphicon glyphicon-book   blue-h"></span> <strong class="blue-h"> الخبرات :</strong> </h3>
            <hr>
            <div class="col-md-12">
                <p style="font-size: 20px;">
                    <?= $model->experience ?>
                </p>
            </div>
        </div>

        </div>
        <hr />
        <div class="row note">
            <div class="col-md-12">
                <p style="margin-top: 40px;">
                   <span class="glyphicon glyphicon-star-empty"></span>
                الموظف الذي يحمل هذه السيره الذاتية يرجى التوصيه به بنأ على الوصف والمواصفات الوظيفية

                </p>
            </div>
        </div>
             
    </div>        

</div>

