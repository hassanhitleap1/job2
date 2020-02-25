<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = Yii::t('app', 'Update Requast Job: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info btn-lg btn-left']) ?>
            <h1><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <?php $phone = substr($model->phone, 1); ?>
    <?= Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=شكرا لتعاملكم مع جرس للخدمات الوجستية نود اعلامكم عن توفر وظيفة    '     '  لدى مؤسسة للاستفسار الاتصال على الرقم التالي", ['target' => '_blank', 'class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]); ?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>