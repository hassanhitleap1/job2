<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Schools */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Schools'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<style>
    .carousel-indicators.carousel-indicators--thumbnails li {
        width: 80px;
        height: 40px;
        margin: 0;
        border: none;
        border-radius: 0;
    }
    .carousel-indicators.carousel-indicators--thumbnails .active {
        background-color: transparent;
    }
    .carousel-indicators.carousel-indicators--thumbnails .active .thumbnail {
        border-color: #337ab7;
    }
</style>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="panel panel-default">
        <div class="panel-heading">
           <h1> <?=Yii::t('app','School') .' '. $model->name ?> </h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-md-8 col-md-offset-2">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
                                <!-- Indicators -->
                                <ol class="carousel-indicators carousel-indicators--thumbnails">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active">
                                        <div class="thumbnail">
                                            <img src="http://www.fillmurray.com/800/400" class="img-responsive">
                                        </div>
                                    </li>
                                    <li data-target="#carousel-example-generic" data-slide-to="1">
                                        <div class="thumbnail">
                                            <img src="http://www.fillmurray.com/800/401" class="img-responsive">
                                        </div>
                                    </li>
                                    <li data-target="#carousel-example-generic" data-slide-to="2">
                                        <div class="thumbnail">
                                            <img src="http://www.fillmurray.com/800/402" class="img-responsive">
                                        </div>
                                    </li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="http://www.fillmurray.com/800/400" width="800" height="400">
                                        <div class="carousel-caption">
                                            Slide 1
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="http://www.fillmurray.com/800/401" width="800" height="400">
                                        <div class="carousel-caption">
                                            Slide 2
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="http://www.fillmurray.com/800/402" width="800" height="400">
                                        <div class="carousel-caption">
                                            Slide 3
                                        </div>
                                    </div>
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top: 10px">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home">Home</a></li>
                    <li><a data-toggle="tab" href="#menu1">Menu 1</a></li>
                    <li><a data-toggle="tab" href="#menu2">Menu 2</a></li>
                    <li><a data-toggle="tab" href="#menu3">Menu 3</a></li>
                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3>HOME</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3>Menu 1</h3>
                        <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3>Menu 2</h3>
                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3>Menu 3</h3>
                        <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-footer">

        </div>
    </div>

</div>
