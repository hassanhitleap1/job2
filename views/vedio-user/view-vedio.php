<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\VedioUser */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vedio Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<link rel="icon" href="https://cdn.plyr.io/static/icons/favicon.ico" />
<link rel="icon" type="image/png" href="https://cdn.plyr.io/static/icons/32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="https://cdn.plyr.io/static/icons/16x16.png" sizes="16x16" />
<link rel="apple-touch-icon" sizes="180x180" href="https://cdn.plyr.io/static/icons/180x180.png" />

<link rel="stylesheet" href="dist/demo.css" />

<!-- Preload -->
<link
        rel="preload"
        as="font"
        crossorigin
        type="font/woff2"
        href="https://cdn.plyr.io/static/fonts/gordita-medium.woff2"
/>
<link
        rel="preload"
        as="font"
        crossorigin
        type="font/woff2"
        href="https://cdn.plyr.io/static/fonts/gordita-bold.woff2"
/>

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

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="container">
        <video
                controls
                crossorigin
                playsinline
                controlsList="nodownload"
                data-poster="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg"
                id="player"
        >
            <!-- Video files -->
            <source
                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4"
                    type="video/mp4"
                    size="576"
            />
            <source
                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4"
                    type="video/mp4"
                    size="720"
            />
            <source
                    src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4"
                    type="video/mp4"
                    size="1080"
            />

        
        </video>
    </div>


</div>

<script src="dist/demo.js" crossorigin="anonymous"></script>