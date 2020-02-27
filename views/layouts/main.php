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
          $menuItems[] =['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
           // $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
            $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
            $menuItems[] = ['label' => Yii::t('app', 'Requast_Job'), 'url' => ['/requat-job/index']];
          
        } else {
            $menuItems[] = [
                'label' =>Yii::t('app', 'Additional') ,
                'items' => [

                    ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message/index']],
                    ['label' => Yii::t('app', 'Message_Merchent'), 'url' => ['/user-message-merchant/index']],
                    ['label' => Yii::t('app', 'Categories'), 'url' => ['/categories/index']],
                    ['label' => Yii::t('app', 'Governorate'), 'url' => ['/governorate/index']],
                    ['label' => Yii::t('app', 'Nationality'), 'url' => ['/nationality/index']],
                    ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']],
                    ['label' => Yii::t('app', 'Pages'), 'url' => ['/pages/index']],
                    ['label' => Yii::t('app', 'Payments'), 'url' => ['/manual-payment-user/index']],
                    ['label' => Yii::t('app', 'Name_OF_Jobs'), 'url' => ['/name-of-Jobs/index']],
                    ['label' => Yii::t('app', 'Requast_Jobs_Google'), 'url' => ['/requast-job-google/index']],
                ],
            ];
            $menuItems[] = ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message-whatsapp/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Requast_Job'), 'url' => ['/requast-job/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['/merchant/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Request_Merchant'), 'url' => ['/request-merchant/index']];
            $menuItems[] = ['label' => Yii::t('app', 'Requast_Job_Not_Pay'), 'url' => ['/requast-job-not-pay/index']];
            //$menuItems[] = ['label' => Yii::t('app', 'Categories'), 'url' => ['/categories/index']];
           // $menuItems[] = ['label' => Yii::t('app', 'Governorate'), 'url' => ['/governorate/index']];
           // $menuItems[] = ['label' => Yii::t('app', 'Nationality'), 'url' => ['/nationality/index']];
            //$menuItems[] = ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']];
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