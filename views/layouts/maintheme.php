<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use lo\modules\noty\Wrapper;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="جرس لتسويق الكفاءات ">
    <meta name="keywords" content="[jaras for job,jaras,job,جرس للخدمات,وظائف,جرس لتسويق الكفاءات,جرس">
    <?php $this->registerCsrfMetaTags() ?>
    <title> <?= Yii::$app->name . " - " . Html::encode($this->title) ?> </title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
        NavBar::begin([
            //'brandLabel' => Html::img('@web/images/logo.svg'),
            'brandLabel' => '<div>' . Yii::$app->name . Html::img('@web/images/logo.svg', ['class' => 'logo']) . '</div>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => Yii::t('app', 'Create_Requast_Job'), 'url' => ['/requat-job/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
        } else {

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '( ' . Yii::t('app', 'Logout') . ' ' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>';
        }
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $menuItems,
        ]);
        NavBar::end();
        ?>

        <?= Alert::widget() ?>
        <?= $content ?>
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4">

        <!-- Footer Links -->
        <div class="container-fluid text-center text-md-left">

            <!-- Grid row -->
            <div class="row">

                <!-- Grid column -->
                <div class="col-md-6 mt-md-0 mt-3">

                    <!-- Content -->
                    <h5 class="text-uppercase">جرس</h5>
                    <p>جرس لتسويق الكفاءات الاردنية.</p>

                </div>
                <!-- Grid column -->

                <hr class="clearfix w-100 d-md-none pb-3">

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">الروابط</h5>

                    <ul class="list-unstyled">


                        <li>
                            <?= Html::a(Yii::t('app', 'About'), ['/site/about']) ?>

                        </li>
                        <li>
                            <?= Html::a(Yii::t('app', 'OurVision'), ['/site/our-vision']) ?>
                        </li>
                        <li>
                            <?= Html::a(Yii::t('app', 'OurMessage'), ['/site/our-message']) ?>
                        </li>

                    </ul>

                </div>
                <!-- Grid column -->

                <!-- Grid column -->
                <div class="col-md-3 mb-md-0 mb-3">

                    <!-- Links -->
                    <h5 class="text-uppercase">روابط</h5>

                    <ul class="list-unstyled">
                        <li>
                            <?= Html::a(Yii::t('app', 'GrowthStrategies'), ['/site/our-goals']) ?>
                        </li>
                        <li>
                            <?= Html::a(Yii::t('app', 'RateUs'), ['/site/growth-strategies']) ?>
                        </li>
                        <li>
                            <?= Html::a(Yii::t('app', 'RateUs'), ['/site/rate-us']) ?>
                        </li>
                        <li>
                            <?= Html::a(Yii::t('app', 'OurResponsibility'), ['/site/our-responsibility']) ?>
                        </li>

                    </ul>

                </div>
                <!-- Grid column -->

            </div>
            <!-- Grid row -->

        </div>
        <!-- Footer Links -->

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?>

        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>