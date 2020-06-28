<?php

use app\models\RequastJobForm;
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
            $deff = Carbon::parse(Carbon::now("Asia/Amman"))
               ->floatDiffInDays($searchModel->smssend->updated_at, false);
            
                
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
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],

            'certificates:ntext',
            'experience:ntext',
            [
                'attribute' => 'priorities',
                'value' => 'priorities',
                'format' => 'html',
                'label'=>Yii::t('app', 'Courses')
            ],
            
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
                'attribute' => 'action_user',
                'value' => function ($searchModel) {

                    switch ($searchModel->action_user) {
                        case RequastJobForm::NOT_INTERVIEWED:
                            return Yii::t('app', 'NOT_INTERVIEWED');
                            break;
                        case RequastJobForm::WAS_INTERVIEWED:
                            return Yii::t('app', 'WAS_INTERVIEWED');
                            break;
                        case RequastJobForm::IGNORAE:
                            return Yii::t('app', 'IGNORAE');
                            break;
                        case RequastJobForm::BUSY:
                            return Yii::t('app', 'BUSY');
                            break;
                        case RequastJobForm::CONTRACT_WAS_SIGNED:
                            return Yii::t('app', 'CONTRACT_WAS_SIGNED');
                            break;
                        default:
                            return Yii::t('app', 'NOT_INTERVIEWED');
                    }
                },
                'filter' => [
                    RequastJobForm::NOT_INTERVIEWED  => Yii::t('app', 'NOT_INTERVIEWED'),
                    RequastJobForm::WAS_INTERVIEWED  => Yii::t('app', 'WAS_INTERVIEWED'),
                    RequastJobForm::IGNORAE  => Yii::t('app', 'IGNORAE'),
                    RequastJobForm::BUSY  => Yii::t('app', 'BUSY'),
                    RequastJobForm::CONTRACT_WAS_SIGNED  => Yii::t('app', 'CONTRACT_WAS_SIGNED'),
                ],


                'format' => 'html',
                'contentOptions' => function ($searchModel) {
                    return ['class' => 'class_action_' . $searchModel->id];
                }
            ],
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {delete} {Cv} {update} {sendwhatsapp} {msgwhatsapp}{action_user} {forgot-password}',  // the default buttons + your custom button
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

