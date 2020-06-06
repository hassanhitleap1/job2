<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = Yii::t('app', 'Create_Requast_Job');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

<div class="row ">
        <div class="col-md-12">
            <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info btn-lg btn-left']) ?>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
</div>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>