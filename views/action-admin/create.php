<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ActionAdmin */

$this->title = Yii::t('app', 'Create Action Admin');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Action Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
