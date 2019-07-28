<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = Yii::t('app', 'Create Requast Job');
?>
<h1><?= Html::encode($this->title) ?></h1>

<?= $this->render('_form', ['model' => $model,]) ?>


