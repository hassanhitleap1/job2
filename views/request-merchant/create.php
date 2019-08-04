<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchant */

$this->title = Yii::t('app', 'Create Request Merchant');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
