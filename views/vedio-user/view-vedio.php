<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VedioUser */

$this->title = $model->user->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vedio Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<link rel="stylesheet" href="dist/demo.css" />

<?php $path_web = Yii::getAlias('@web') . '/' .  $model->path ?>
<!-- Preload -->
<!-- Google Analytics-->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-132699580-1"></script>
<script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
                dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'UA-132699580-1');
</script>

<div class="container">
        <div class="panel panel-default">
                <div class="panel-heading">
                        <?= Html::encode($this->title) ?>
                </div>
                <div class="panel-body">

                        <video controls crossorigin playsinline controlsList="nodownload" data-poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
                                <!-- Video files -->
                                <source src="<?= $path_web ?>" type="video/mp4" size="576" />
                                <source src="<?= $path_web ?>" type="video/mp4" size="720" />
                                <source src="<?= $path_web ?>" type="video/mp4" size="1080" />


                        </video>


                </div>
        </div>
</div>
<script src="dist/demo.js" crossorigin="anonymous"></script>