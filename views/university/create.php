<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\University */

$this->title = Yii::t('app', 'Create_University');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Universities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?></p>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>