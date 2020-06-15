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
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1> <?= Yii::t('app', 'School') . ' ' . $model->name ?> </h1>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php if (count($model->imagesSchools) != 0) : ?>
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="5000">
                            <!-- Indicators -->
                            <ol class="carousel-indicators carousel-indicators--thumbnails">
                                <?php $i = 0 ?>
                                <?php foreach ($model->imagesSchools as $key => $value) : ?>
                                    <li data-target="#carousel-example-generic" data-slide-to="<?= $i ?>" class="<?= ($i == 0) ? 'active' : '' ?>">
                                        <div class="thumbnail">
                                            <?= Html::img($value->path, ['class' => 'img-responsive']); ?>
                                        </div>
                                    </li>
                                    <?php $i++; ?>
                                <?php endforeach; ?>

                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <?php $i = 0 ?>
                                <?php foreach ($model->imagesSchools as $key => $value) : ?>
                                    <div class="item <?= ($i == 0) ? 'active' : '' ?>">
                                        <?= Html::img($value->path, ['style' => ['width' => '800', 'height' => '400']]); ?>
                                        <div class="carousel-caption">
                                            Slide <?= $i ?>
                                        </div>
                                    </div>
                                    <?php $i++; ?>
                                <?php endforeach; ?>


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
                <?php endif; ?>
            </div>
        </div>

        <div class="container">
            <div class="row" style="margin-top: 10px">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#home"><?= Yii::t('app', 'Details') ?></a></li>
                    <li><a data-toggle="tab" href="#menu1"><?= Yii::t('app', 'Director_Word') ?></a></li>
                    <li><a data-toggle="tab" href="#menu2"><?= Yii::t('app', 'Discounts_Form') ?></a></li>
                    <li><a data-toggle="tab" href="#menu3"><?= Yii::t('app', 'Brochure') ?></a></li>
                    <li><a data-toggle="tab" href="#menu4"><?= Yii::t('app', 'Contact_Information') ?></a></li>
                    <li><a data-toggle="tab" href="#menu5"><?= Yii::t('app', 'Map') ?></a></li>

                </ul>

                <div class="tab-content">
                    <div id="home" class="tab-pane fade in active">
                        <h3><?= Yii::t('app', 'Details') ?></h3>
                        <p>
                            <?= $model->details ?>
                        </p>
                    </div>
                    <div id="menu1" class="tab-pane fade">
                        <h3><?= Yii::t('app', 'Director_Word') ?></h3>
                        <p>
                            <?= $model->director_word ?>
                        </p>
                    </div>
                    <div id="menu2" class="tab-pane fade">
                        <h3><?= Yii::t('app', 'Discounts_Form') ?></h3>
                        <p>
                            <?= $model->discounts_form ?>
                        </p>
                    </div>
                    <div id="menu3" class="tab-pane fade">
                        <h3><?= Yii::t('app', 'Brochure') ?></h3>
                        <p>
                            <?= $model->brochure ?>
                        </p>
                    </div>
                    <div id="menu4" class="tab-pane fade">
                        <h3><?= Yii::t('app', 'Contact_Information') ?></h3>
                        <p>
                            
                        </p>
                    </div>
                    <div id="menu5" class="tab-pane fade">
                        <h3><?= Yii::t('app', 'Map') ?></h3>
                        <p>
                           
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>