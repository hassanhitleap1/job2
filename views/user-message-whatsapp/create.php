<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserMessageWhatsapp */

$this->title = Yii::t('app', 'Create User Message Whatsapp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Message Whatsapps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
