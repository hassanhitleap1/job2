<?php

use app\models\User;
use app\models\UserMessage;
use Carbon\Carbon;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequastJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$dataModel=UserMessage::find()->where(['user_id'=>Yii::$app->user->id])->one();
$message=($dataModel==null)?'':$dataModel->text;


$this->title = Yii::t('app', 'Requast_Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Requast_Job'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($searchModel){
            if($searchModel->smssend->created_at==null ){
                return ['class' => 'danger'];
            }
            $deff = Carbon::parse(Carbon::now("Asia/Amman"))
               ->floatDiffInDays($searchModel->smssend->updated_at, false);

            if($searchModel->smssend->count==1 ){
                if($deff >= 7){
                    return ['class' => 'danger'];
                }
               
            }elseif ($searchModel->smssend->count == 2) {
            # code...
                if ($deff >= 14) {
                    return ['class' => 'danger'];
                }
               
            }elseif ($searchModel->smssend->count == 3) {
            # code...
                if ($deff >= 21) {
                    return ['class' => 'danger'];
                }
                
            }
            
                
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'agree',
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
                'filter' =>[0=>"غير محدد",1=>" ذكر",2=>" انثى"],

                'format' => 'html',
            ],
            'phone',
            [
                'attribute' => 'area',
                'value' => 'area',

            ],
            [
                'attribute' => 'nationality',
                'value' => 'nationality0.name_ar',

            ],
            [
                'attribute' => 'category_id',
                'value' => 'category0.name_ar',

            ],
            
            [
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],

            [
                'attribute' => 'subscribe_date',
                'value' => 'subscribe_date',
                'format' => 'html',
            ],
            'certificates:ntext',
            'experience:ntext',
            'priorities:ntext',
            'note:ntext',
            [
                'attribute' => 'created_at',
                'label'=> Yii::t('app', 'Created_At'),
                'value'=> function($searchModel){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($searchModel->created_at));
                    $mess="";
                    $def=$date->diffInDays($now);
                    return "registered befor ". $def ;
                }
            ],
            [
                'attribute' => 'counsendsms',   
                'value' => 'smssend.count',
                'contentOptions' => function($searchModel)
                    {
                        return ['class' => 'class_num_' . $searchModel->id];
                    }
            ],
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete} {Cv} {update} {sendwhatsapp} {msgwhatsapp}{action_user}',  // the default buttons + your custom button
            'buttons' => [
                  'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                                    'class' => 'btn btn-info'
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-update'),
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                        ]);
                    },
                    'Cv' => function($url, $model, $key) {
                          // render your custom button
                        return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],['class' => 'btn btn-info glyphicon glyphicon-th', 'data-pjax' => 0]);
                    },
                    'msgwhatsapp' => function ($url, $model,$key) {
                        $url="index.php?r=requast-job-not-pay/msgwhatsapp&id=".$model->id;
                        return Html::button(' '.Yii::t('app', 'msgwhatsapp') , ['value' => $url,
                            'title' => Yii::t('app', 'msgwhatsapp'),
                            'class' => 'glyphicon glyphicon-envelope','data-pjax' => 0]);
                    },

                    'sendwhatsapp' => function ($url, $model, $key)use($message) {     // render your custom button
                        $phone=substr($model->phone, 1);;
                        return  Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank','class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]);
                    },
                'action_user' => function ($url, $model, $key) {
                    $url = "index.php?r=requast-job/action_user&id=" . $model->id;
                    return Html::button('', [
                        'value' => $url,
                        'title' => Yii::t('app', 'Action_User'),
                        'class' => 'action_user  glyphicon glyphicon-cog', 'data-pjax' => 0
                    ]);
                },

                
            ]
            ],
           
        ],
    ]); ?>

    <?php Pjax::end(); ?>
 
    <?php
$script = <<< JS
$(document).on('click', '#modelbutton', function(){
    url=$(this).attr('value');
    $('#model').load(url).modal({ show: true });;
});

$(document).on('click', '#show', function(){
    url=$(this).attr('value');
    $('#model').load(url).modal({ show: true });;
});

$(document).on('click', '#plusbutton', function(){
    id=$(this).attr('value');
    $.get("index.php?r=requast-job/plus&id="+id, function(data, status){
        var data = jQuery.parseJSON( data );
        $(".class_num_"+id).text( data.count );
    });
});

$(document).on('click', '#minusbutton', function(){
    id=$(this).attr('value');
    
    $.get("index.php?r=requast-job/minus&id="+id, function(data, status){
        var data = jQuery.parseJSON( data );
        $(".class_num_"+id).text( data.count );
    });
});





JS;
$this->registerJs($script);
?>

    <?php

    Modal::begin([
        'id'     => 'model',
        'size'   => 'model-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();

    ?>

</div>

