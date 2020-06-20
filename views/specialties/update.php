<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Specialties */

$this->title = Yii::t('app', 'Update_Specialties');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Specialties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">
    <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info btn-lg btn-left']) ?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>