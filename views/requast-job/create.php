<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = Yii::t('app', 'Create_Requast_Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', ['model' => $model,]) ?>


