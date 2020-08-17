<?php


use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vedio_Not_Found'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="alert alert-danger" role="alert">
        <h2><?= Yii::t('app', 'Vedio_Not_Found') ?></h2>
    </div>

</div>