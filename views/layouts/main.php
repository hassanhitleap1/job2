<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\User;
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
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-171714994-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-171714994-1');
</script>

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
        $menuItemsLeft=array();
        if (Yii::$app->user->isGuest) {
             $menuItems[] =['label' => Yii::t('app', 'Home'), 'url' => ['/site/index']];
           // $menuItems[] = ['label' => Yii::t('app', 'Signup'), 'url' => ['/site/signup']];
            $menuItems[] = ['label' => Yii::t('app', 'Login'), 'url' => ['/site/login']];
            $menuItems[] = ['label' => Yii::t('app', 'Requast_Job'), 'url' => ['/requat-job/index']];
          
        } else {
            if(Yii::$app->user->identity->type == User::ADMIN_USER){
                $menuItems[] = [
                    'label' =>Yii::t('app', 'Additional') ,
                    'items' => [
                        ['label' => Yii::t('app', 'Posts'), 'url' => ['/posts/index']],
                        ['label' => Yii::t('app', 'Admins'), 'url' => ['/admin/index']],
                        ['label' => Yii::t('app', 'Action_Admins'), 'url' => ['/action-admin/index']],
                        ['label' => Yii::t('app', 'Categories'), 'url' => ['/categories/index']],
                        ['label' => Yii::t('app', 'Governorate'), 'url' => ['/governorate/index']],
                        ['label' => Yii::t('app', 'Nationality'), 'url' => ['/nationality/index']],
                        ['label' => Yii::t('app', 'Countries'), 'url' => ['/countries/index']],
                        ['label' => Yii::t('app', 'Regions'), 'url' => ['/regions/index']],
                        ['label' => Yii::t('app', 'Area'), 'url' => ['/area/index']],
                        ['label' => Yii::t('app', 'Pages'), 'url' => ['/pages/index']],
                        ['label' => Yii::t('app', 'Payments'), 'url' => ['/manual-payment-user/index']],
                        ['label' => Yii::t('app', 'Name_Of_Jobs'), 'url' => ['/name-of-jobs/index']],
                        ['label' => Yii::t('app', 'Requast_Jobs_Google'), 'url' => ['/requast-job-google/index']],
                        ['label' => Yii::t('app', 'Schools'), 'url' => ['/schools/index']],
                        ['label' => Yii::t('app', 'University'), 'url' => ['/university/index']],
                        ['label' => Yii::t('app', 'Degrees'), 'url' => ['/degrees/index']],
                        ['label' => Yii::t('app', 'Courses'), 'url' => ['/courses/index']],
                        ['label' => Yii::t('app', 'Experiences'), 'url' => ['/experiences/index']],
                        ['label' => Yii::t('app', 'Educational_Attainment'), 'url' => ['/educational-attainment/index']],
                        ['label' => Yii::t('app', 'Specialties'), 'url' => ['/specialties/index']],
                        ['label' => Yii::t('app', 'School_Owners'), 'url' => ['/school-owners/index']],
                        ['label' => Yii::t('app', 'Style'), 'url' => ['/style/index']],
                    ],
                ];


                $menuItems[] = [
                    'label' =>Yii::t('app', 'Custum_Massage') ,
                    'items' => [
                        ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message/index']],
                        ['label' => Yii::t('app', 'Message_Merchent'), 'url' => ['/user-message-merchant/index']],
                        ['label' => Yii::t('app', 'Message_Clarification'), 'url' => ['/user-message-clarification/index']],
                        ['label' => Yii::t('app', 'Message_Zoom'), 'url' => ['/user-message-zoom/index']],
                        ['label' => Yii::t('app', 'Message_School_Owner'), 'url' => ['/message-school-owners/index']],
                    ],
                ];

                $menuItems[] = [
                    'label' =>Yii::t('app', 'Merchants') ,
                    'items' => [
                        ['label' => Yii::t('app', 'UserMerchants'), 'url' => ['/user-marchent/index']],
                        ['label' => Yii::t('app', 'Merchants'), 'url' => ['/merchant/index']],
                        ['label' => Yii::t('app', 'Request_Merchant'), 'url' => ['/request-merchant/index']]
                    ],
                ];

                $menuItems[] = [
                    'label' =>Yii::t('app', 'Requast_Job') ,
                    'items' => [
                        ['label' => Yii::t('app', 'Users'), 'url' => ['/users/index']],
                        ['label' => Yii::t('app', 'Requast_Job_Form'), 'url' => ['/requast-job-form/index']],
                        ['label' => Yii::t('app', 'Requast_Job_Pay'), 'url' => ['/requast-job/index']],
                        ['label' => Yii::t('app', 'Requast_Job_Not_Pay'), 'url' => ['/requast-job-not-pay/index']]
                    ],
                ];
                $menuItems[] = ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message-whatsapp/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']];
            }elseif (Yii::$app->user->identity->type == User::NORMAL_ADMIN){
                $menuItems[] = [
                    'label' =>Yii::t('app', 'Custum_Massage') ,
                    'items' => [
                        ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message/index']],
                        ['label' => Yii::t('app', 'Message_Merchent'), 'url' => ['/user-message-merchant/index']],
                        ['label' => Yii::t('app', 'Message_Clarification'), 'url' => ['/user-message-clarification/index']],
                        ['label' => Yii::t('app', 'Message_Zoom'), 'url' => ['/user-message-zoom/index']],
                        ['label' => Yii::t('app', 'Message_School_Owner'), 'url' => ['/message-school-owners/index']],
                    ],
                ];
   

                $menuItems[] = [
                    'label' =>Yii::t('app', 'Requast_Job') ,
                    'items' => [
                        ['label' => Yii::t('app', 'Requast_Job_Form'), 'url' => ['/requast-job-form/index']],
                        ['label' => Yii::t('app', 'Requast_Job_Pay'), 'url' => ['/requast-job/index']],
                        ['label' => Yii::t('app', 'Requast_Job_Not_Pay'), 'url' => ['/requast-job-not-pay/index']]
                    ],
                ];
                $menuItems[] = ['label' => Yii::t('app', 'Message'), 'url' => ['/user-message-whatsapp/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']];
            }elseif (Yii::$app->user->identity->type == User::MERCHANT_USER){
                $menuItems[] = ['label' => Yii::t('app', 'Requast_Job_Form'), 'url' => ['/users/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']];
            }elseif (Yii::$app->user->identity->type == User::Advertiser){
                $menuItems[] = ['label' => Yii::t('app', 'My_Adv'), 'url' => ['/posts/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Users'), 'url' => ['/users-applay/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']];
            }else{
                $menuItems[] = ['label' => Yii::t('app', 'Upload_Vedio'), 'url' => ['/upload-vedio/index']];
                $menuItems[] = ['label' => Yii::t('app', 'My_Request'), 'url' => ['/my-request/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Contract'), 'url' => ['/documents/index']];
                $menuItems[] = ['label' => Yii::t('app', 'Change_Password'), 'url' => ['/change-password/index']];
                
            }


            $menuItemsLeft[] = '<li>'
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

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-left'],
            'items' => $menuItemsLeft,
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
