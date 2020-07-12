<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Governorate */

$this->title = Yii::t('app', 'Update_Governorate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Governorates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">

    <h1>
        <?= Html::encode($this->title) ?>
    </h1>
    <p><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?></p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>