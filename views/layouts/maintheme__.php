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
            'brandLabel' =>'<div>'.Yii::$app->name. Html::img('@web/images/logo.svg',['class'=>'logo']).'</div>',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => Yii::t('app', 'Create_Requast_Job'), 'url' => ['/requat-job/index']];
            $menuItems[] = ['label' => Yii::t('app', 'About'), 'url' => ['/site/about']];
            $menuItems[] = ['label' => Yii::t('app', 'OurVision'), 'url' => ['/site/our-vision']];
            $menuItems[] = ['label' =>Yii::t('app', 'OurMessage'), 'url' => ['/site/our-message']];
            $menuItems[] = ['label' =>Yii::t('app', 'OurGoals'),'url' =>  ['/site/our-goals']];
            $menuItems[] = ['label' =>Yii::t('app', 'GrowthStrategies'), 'url' => ['/site/growth-strategies']];
            $menuItems[] = ['label' =>Yii::t('app', 'RateUs'), 'url' => ['/site/rate-us']];
            $menuItems[] = ['label' =>Yii::t('app', 'OurResponsibility'),'url' =>  ['/site/our-responsibility']];
            $menuItems[] = ['label' =>Yii::t('app', 'Login'),'url' =>  ['/site/login']];

        } else {

            $menuItems[] = '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    '( '.Yii::t('app', 'Logout'). ' ' . Yii::$app->user->identity->username . ')',
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


    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

            <p class="pull-right">by kiwan group</p>
        </div>
    </footer>
    <?php $this->endBody() ?>
    </body>

    </html>
<?php $this->endPage() ?>