<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\models\Pages;use yii\helpers\Html;
use app\assets\ThemeAsset;

ThemeAsset::register($this);
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
<body class="is-preload">
<?php $this->beginBody() ?>

		<!-- Header -->
        <header id="header">
                <?= Html::a(Yii::$app->name, ['/site/index'],['class'=>'logo']) ?>
				<nav>
					<a href="#menu"> <?= Yii::t('app', 'Menu')?></a>
				</nav>
			</header>

		<!-- Nav -->
			<nav id="menu">
				<ul class="links">
					<li>
                        <?= Html::a(Yii::t('app', 'Home'), ['/site/index']) ?>
                    </li>
                    <li>
                        <?= Html::a(Yii::t('app', 'About'), ['/site/about']) ?>
					</li>
					<li>
                        <?= Html::a(Yii::t('app', 'OurVision'), ['/site/our-vision']) ?>
					</li>
					<li>
                        <?= Html::a(Yii::t('app', 'OurMessage'), ['/site/our-message']) ?>
					</li>
					<li>
                        <?= Html::a(Yii::t('app', 'OurGoals'), ['/site/our-goals']) ?>
					</li>
					<li>
                        <?= Html::a(Yii::t('app', 'GrowthStrategies'), ['/site/growth-strategies']) ?>
					</li>
					<li>
                        <?= Html::a(Yii::t('app', 'RateUs'), ['/site/rate-us']) ?>
                    </li>
                    <li>
                        <?= Html::a(Yii::t('app', 'OurResponsibility'), ['/site/our-responsibility']) ?>
					</li>
					<?php if(Yii::$app->user->isGuest):?>
					<li>
                        <?= Html::a(Yii::t('app', 'Login'), ['/site/login']) ?>
					</li>
					<?php else:?>

					<?php endif;?>
					
				</ul>
            </nav>
            
   <?= $content ?>    

	<!-- Footer -->
    <footer id="footer">
				<div class="inner">
					<div class="content">
						<section>
							<h3><?= Yii::t('app', 'OurVision')?></h3>
							<p><?= Pages::find()->where(['key'=>'our-vision'])->one()->text;?></p>
						</section>

						<section>
							<h4>Magna sed ipsum</h4>
							<ul class="plain">
								<li><a href="#"><i class="icon fa-twitter">&nbsp;</i>Twitter</a></li>
								<li><a href="#"><i class="icon fa-facebook">&nbsp;</i>Facebook</a></li>
							</ul>
						</section>
					</div>
					<div class="copyright">
						&copy; jaras group.
					</div>
				</div>
			</footer>
		<!-- Footer -->

<?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>