<?php
use yii\helpers\Html;

$this->title = Yii::t('app', 'CV');
$this->params['breadcrumbs'][] = $this->title;
?>
<div id="main-wrapper">

<div class="columns-block container">
    <div class="left-col-block blocks">
        <header class="header theiaStickySidebar">
            <div class="profile-img">
                    <?php if ($model->avatar == null): ?>
                            <?=Html::img('@web/images/profile.png', ['class' => 'img-responsive']) ?>
                    <?php else: ?>
                            <?=Html::img("@web/$model->avatar", ['class' => 'img-responsive']) ?>
                    <?php endif; ?>
             
            </div>
            <div class="content">
                <h1><?=$model->name ?></h1>
                <span class="lead">Marketing Consultant</span>
                <div class="about-text">
                <div class="row">
                        <div class="col-md-12">
                            <address>
                                           
                                        <strong>هاتف</strong>
                                            <br>
                                                <?=$model->phone ?> 
                                       
                                        </address>
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
                                        <?=($model->gender == 1) ? 'ذكر' : ($model->gender == 2) ? 'انثى' : 'غير محدد'; ?> 
                                        </address>
                        </div>
                    </div>
                </div>


                <div class="row">
                        <div class="col-md-12">
                            <div class="progress-wrapper">
                                <div class="progress-item">
                                    <span class="progress-title">قدره تحمل العمل </span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 62%"><span class="progress-percent"> 90%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title"> العمل بروح الفريق</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%"><span class="progress-percent"> 90%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title">Organisational Skills</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"><span class="progress-percent"> 75%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title">الالتزام الرسمي بالدوام</span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="87" aria-valuemin="0" aria-valuemax="100" style="width: 55%;"><span class="progress-percent"> 87%</span>
                                        </div>
                                    </div>

                                </div>

                                <div class="progress-item">
                                    <span class="progress-title">مهارات التواصل </span>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"><span class="progress-percent"> 85%</span>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>

            </div>
        </header>

    </div>

    <div class="right-col-block blocks">
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
                                <small>2012 - 2015</small>
                                <h3>Media Analyst</h3>
                                <h4>BizzNiss</h4>
                                <p>United Kingdom, London</p>
                            </div>

                            <div class="content-item">
                                <small>2010 - 2012</small>
                                <h3>Budget Administrator</h3>
                                <h4>Somsom LLC</h4>
                                <p>United Kingdom, London</p>
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
                            </div>

                        </div>
                    </div>

                </div>

            </section>

          
        </div>

    </div>

</div>

</div>



<div class="container">
    <div class="row">
        <?=Html::a(Yii::t('app', 'Print_CV') , ['requast-job/cv', array(
    'id' => $model->id
        ) ], ['class' => 'btn btn-primary btn-lg'])
        ?>
                
    </div>
</div>
