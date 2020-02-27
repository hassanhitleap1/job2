<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NameOfJobs */

$this->title = Yii::t('app', 'Create Name Of Jobs');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Name Of Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="name-of-jobs-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
