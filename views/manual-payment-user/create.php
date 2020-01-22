<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ManualPaymentUser */

$this->title = Yii::t('app', 'Create Manual Payment User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Manual Payment Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
