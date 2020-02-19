<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserMessageWhatsapp */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Message Whatsapps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'test:ntext',
            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user0->name;
                },

            ],

            [
                'attribute' => 'marchent_id',
                'value' => function($model){
                    return $model->marchent0->name;
                },

            ],

            'created_at',

            [
                'attribute' => 'created_at',
                'value' => function($model){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($model->created_at));
                     $def=$date->diffInDays($now);
                     return "send befor ". $def;
                    }
            ],



//            'updated_at',
        ],
    ]) ?>

</div>
