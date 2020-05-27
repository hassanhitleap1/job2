<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Degrees */

$this->title = Yii::t('app', 'Create Degrees');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Degrees'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?></p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
