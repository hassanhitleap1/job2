<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\VideoVimo */

$this->title = Yii::t('app', 'Create Video Vimo');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Video Vimos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
