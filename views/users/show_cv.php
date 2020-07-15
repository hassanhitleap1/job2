<?php
use yii\helpers\Html;
use app\models\User;
$this->title = Yii::t('app', 'CV');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="main-wrapper">
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
        crossorigin="anonymous"></script>
<div class="columns-block container " id="cv_div">
    <div class="left-col-block blocks">
        <header class="header theiaStickySidebar">
            <div class="profile-img">
                    <?php if ($model->avatar == null): ?>
                            <?php if ($model->gender == User::MALE ): ?>
                                <?=Html::img('@web/images/profile.png', ['class' => 'img-responsive']) ?>
                            <?php else: ?>
                                 <?=Html::img('@web/images/female.png', ['class' => 'img-responsive']) ?>
                            <?php endif; ?>
                    <?php else: ?>
                            <?=Html::img("@web/$model->avatar", ['class' => 'img-responsive']) ?>
                    <?php endif; ?>
             
            </div>
            <div class="content ">
                <h1><?=$model->name ?></h1>
                
                <div class="about-text">
                <div class="row text_right">
                        <div class="col-md-12">
                           
                                                                    <address>
                                        <strong>العمر</strong><br>
                                        <?=$model->agree ?>
                                        </address>
                                                                    <address>
                                        <strong>الجنسية</strong><br>
                                        <?=$model->nationality0->name_ar ?>
                                        </address>
                                                <address>
                                        <strong>الجنس</strong><br>
                                        <?php
                                                if ($model->gender == User::MALE) {
                                                echo  "ذكر";
                                            } elseif ($model->gender == User::FEMALE) {
                                                # code...
                                                echo  "انثى";
                                            } else {
                                                echo 'غير محدد';
                                            }?> 
                                        </address>
                        </div>
                    </div>
                </div>


                <div class="row">
                        <div class="col-md-12 text_left">
                            <div class="progress-wrapper">
                                <div class="progress-item">
                                    <span class="progress-title">قدره تحمل العمل </span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $model->work_tolerance?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $model->work_tolerance?>%"><span class="progress-percent"> <?= $model->work_tolerance?>%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title"> العمل بروح الفريق</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $model->teamwork?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $model->teamwork?>%"><span class="progress-percent"> <?= $model->teamwork?>%</span>
                                        </div>
                                    </div>

                                </div>

                              
                                <div class="progress-item">
                                    <span class="progress-title">الالتزام الرسمي بالدوام</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $model->work_permanently?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $model->work_permanently?>%;"><span class="progress-percent"> <?= $model->work_permanently?>%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title">مهارات التواصل </span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $model->communication_skills?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $model->communication_skills?>%;"><span class="progress-percent"> <?= $model->communication_skills?>%</span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

            </div>
        </header>

    </div>

    <div class="right-col-block blocks text_right">
        <div class="theiaStickySidebar">
            <section class="expertise-wrapper section-wrapper gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>عني</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="expertise-item">
                                <h3>الشهادات</h3>
                                <p>
                                    <?=$model->certificates?>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="expertise-item">
                                <h3>الخبرات</h3>
                                <p>
                                    <?=$model->experience?>
                                </p>
                            </div>
                        </div>


                    </div>

                </div>
            </section>

          

            <section class="section-wrapper section-experience gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>مهارات العمل </h2></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-item">
                                <p>القدره علي تعلم المهام الجديده بشكل سريع ومحترف</p>
                                <p> التعامل مع المواقف المختلفه بهدوء وبطريقه مدروسه</p>
                               <p>لماح ومتمكن من ملاحظه التفاصيل الدقيقة</p>
                                <p>مبتكر , واقعي , عملي جدا ومتمكن من التأقلم مع الظروف المحيطه بسرعه</p>
                            </div>

                            <div class="content-item">
                        
                                <h3>ملخص</h3>
                               
                                <p>أسعى إلى إيجاد بيئة تنافسية ومليئة بالتحديات وفقًا لخبرتي ومؤهلاتي ومهاراتي ، التي يمكنني أن أخدم مؤسستك فيها بأداء عالٍ للغاية وأنشئ مهنة مزدهرة لنفسي.</p>
                            </div>

                         

                        </div>
                    </div>

                </div>

            </section>

            <section class="section-wrapper section-experience gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>توصية شركة جرس</h2></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-item">
                                    <?=Html::img('@web/images/logo.svg', ['class' => 'logo ']) ?>
                                    الموظف الذي يحمل هذه السيره الذاتية يرجى التوصيه به بنأ على الوصف والمواصفات الوظيفية ويرجى تزويدنا بتاريخ التوظيف هاتف رقم 0780151570 -0782121456
                            </div>

                        </div>
                    </div>

                </div>

            </section>

          
        </div>

    </div>

</div>

</div>



<!-- <div class="container">
    <div class="row">
         <button class="btn btn-primary btn-lg" id="print_cv" >print</button>       
    </div>
</div> -->
