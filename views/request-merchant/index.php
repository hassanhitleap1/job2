<?php

use app\models\User;
use app\models\UserMessageMerchant;
use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestMerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Request_Merchants');
$this->params['breadcrumbs'][] = $this->title;

$dataModel=UserMessageMerchant::find()->where(['user_id'=>Yii::$app->user->id])->one();
$message=($dataModel==null)?'':$dataModel->text;
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
                'label'=>'منطقة صاحب العمل',
                'value' => function ($searchModel) {
                    return $searchModel['user0']['area0']['name_ar'];
                    }

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
                'value' => function ($searchModel) {
            
                    return "الاسم : " . $searchModel->user0["name"] ."  اسم الشركة: " . $searchModel->user0["name_company"] ;
                }
            ],
            [
                'attribute' => 'category_id',
                'value' => 'category0.name_ar',

            ],
            [
                'attribute' => 'created_at',
                'label' => Yii::t('app', 'Name_Company'),
                'value'=> function($searchModel){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($searchModel->created_at));
                    
                    $def=$date->diffInDays($now);  
                    return "dayes ". $def;
                }
        ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete} {update} {sendwhatsapp} ',  // the default buttons + your custom button
                'buttons' => [
                    'sendwhatsapp' => function ($url, $model, $key)use($message) {     // render your custom button
                        $phone=substr($model->user0['phone'], 1);
                        return  Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank','class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]);
                    },


                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
