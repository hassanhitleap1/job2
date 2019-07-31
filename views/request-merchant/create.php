<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchant */

$this->title = Yii::t('app', 'Create_Request_Merchant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request_Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>


    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


