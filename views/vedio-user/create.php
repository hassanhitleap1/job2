<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VedioUser */

$this->title = Yii::t('app', 'Create Vedio User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Vedio Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
