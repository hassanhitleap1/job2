<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Governorate */

$this->title = Yii::t('app', 'Create_Governorate');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Governorates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="governorate-create">
    <p><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?></p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>