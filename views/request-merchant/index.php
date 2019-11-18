<?php

use app\models\User;
use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestMerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Request_Merchants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Request_Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'job_title',
            [
                'attribute' => 'Phone',
                'value' => 'user0.phone',
            ],
            [
                'attribute' => 'gender',
                'value' => function($searchModel){
                        if ($searchModel->gender == User::MALE) {
                            return "ذكر";
                        } elseif ($searchModel->gender == User::FEMALE) {
                            # code...
                            return "انثى";
                        } else {
                            return 'غير محدد';
                        }
                  
                },
                'filter' =>[0=>"غير محدد", User::MALE=>" ذكر", User::FEMALE=>" انثى"],

                'format' => 'html',

            ],
            'desc_job:ntext',
            'salary_from',
            'salary_to',
            'agree_from',
            'agree_to',
            [
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],
            [
                'attribute' => 'area',
                'value' => 'area0.name_ar',

            ],
            'number_of_houer',
            [
                'attribute' => 'nationality',
                'value' => 'nationality0.name_ar',

            ],
            'note:ntext',
            [
                'attribute' => 'user_id',
                'value' => 'user0.name',

            ],
            [
                'attribute' => 'category_id',
                'value' => 'category0.name_ar',

            ],
            [
                'attribute' => 'created_at',
                'label' => Yii::t('app', 'Created_At'),
                'value'=> function($searchModel){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($searchModel->created_at));
                    
                    $def=$date->diffInDays($now);  
                    return "dayes ". $def;
                }
        ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
