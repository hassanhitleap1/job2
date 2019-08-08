<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Merchant */

$this->title = Yii::t('app', 'Create_Merchant_with_Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsRequestMerchant' => $modelsRequestMerchant
    ]) ?>

</div>
