<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Create_Request_Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            [
                'format' => 'raw',
                'attribute' => 'gender',
                'value' => function($model){
                        return ($model->gender == 1)? 'ذكر' : ($model->gender==2) ? 'انثى' :'غير محدد';
                },
                'filter' =>[0=>"غير محدد",1=>" ذكر",2=>" انثى"],


            ],
            'agree',
            'phone',
            [
            'format' => 'raw',
            'name' => 'governorate',
            'attribute'=> 'governorate',
            'value'=> $model->governorate0->name_ar,
            
            ],
            [
                'format' => 'raw',
                'name' => 'nationality',
                'attribute' => 'nationality',
                'value' => $model->nationality0->name_ar,

            ],
            'certificates:ntext',
            'experience:ntext',
            'governorate0.name_ar',
            'expected_salary',
            'subscribe_date',
            'note:ntext',
        ],
    ]) ?>

</div>