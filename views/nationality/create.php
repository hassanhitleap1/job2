<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Nationality */

$this->title = Yii::t('app', 'Create_Nationality');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Nationalities'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>