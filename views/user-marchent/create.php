<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserMarchent */

$this->title = Yii::t('app', 'Create User Marchent');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Marchents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
