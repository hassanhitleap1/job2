<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app', 'Terms_Conditions');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1><?= Html::encode($this->title) ?></h1>
                </div>
                <div class="panel-body content">
                    <?= $page->text ?>
                </div>
            </div>
        </div>
    </div>
</div>