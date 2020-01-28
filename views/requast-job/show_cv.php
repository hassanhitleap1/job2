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
                                <h2>Work Experience</h2></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-item">
                                <small>2015 - Present</small>
                                <h3>Head of market research</h3>
                                <h4>Computer & Motor Ltd.</h4>
                                <p>United Kingdom, London</p>
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

            <section class="section-wrapper section-education">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Education</h2></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-item">
                                <small>2010 - 2012</small>
                                <h3>MA Product Design</h3>
                                <h4>University of California</h4>
                                <p>United Kingdom, London</p>
                            </div>

                            <div class="content-item">
                                <small>2007 - 2010</small>
                                <h3>Business marketing course</h3>
                                <h4>Royal Academy of Business</h4>
                                <p>United Kingdom, London</p>
                            </div>

                            <div class="content-item">
                                <small>2002 - 2006</small>
                                <h3>BA (Hons) Design</h3>
                                <h4>University of Michigan</h4>
                                <p>United Kingdom, London</p>
                            </div>

                        </div>
                    </div>

                </div>

            </section>

            <section class="section-wrapper section-interest gray-bg">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="section-title">
                                <h2>Interest</h2>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="content-item">
                                <h3>Books</h3>
                                <p>Proactively extend market-driven e-tailers rather than enterprise-wide supply chains. Collaboratively embrace 24/7 processes rather than adaptive users. Seamlessly monetize alternative e-business.</p>
                            </div>
                            <div class="content-item">
                                <h3>Sports</h3>
                                <p>Assertively grow optimal methodologies after viral technologies. Appropriately develop frictionless technology for adaptive functionalities. Competently iterate functionalized networks for best-of-breed services.</p>
                            </div>
                            <div class="content-item">
                                <h3>Art</h3>
                                <p>Dramatically utilize superior infomediaries whereas functional core competencies. Enthusiastically repurpose synergistic vortals for customer directed portals. Interactively pursue sustainable leadership via.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </section>

        </div>

    </div>

</div>

</div>
<div class="row">
    <div class="name-cv col-lg-4 col-md-4 col-offset-3">
        <?=Html::img('@web/images/logo.svg', ['class' => 'logo ']) ?>
        <h3> جرس  : السيرة الذاتية </h3>
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
