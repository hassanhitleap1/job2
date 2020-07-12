<?php

use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserMessageWhatsappSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'User Message Whatsapps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php // Html::a(Yii::t('app', 'Create User Message Whatsapp'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            [
                'attribute' => 'test',
                'contentOptions' => ['class' => 'truncate'],
                'format'=>'html'
            ],

            [
                'attribute' => 'user_id',
                'value' => 'user0.name',

            ],
            [
                'attribute' => 'marchent_id',
                'value' => 'marchent0.name',

            ],
           
            [
                'attribute' => 'created_at',
                'label'=> Yii::t('app', 'Created_At'),
                'value'=> function($searchModel){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($searchModel->created_at));
                     $def=$date->diffInDays($now);
                     return "send befor ". $def;
                    }
            ],
    
            //'updated_at',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete} ',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
