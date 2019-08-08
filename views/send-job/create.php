<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SendJob */

$this->title = Yii::t('app', 'Create_Send_Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Send Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
