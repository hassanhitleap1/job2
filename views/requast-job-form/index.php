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

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions'=>function($searchModel){
            
            if(RequastJobForm::NOT_INTERVIEWED==0){
                    return ['class' => 'danger','id'=> $searchModel->id];
            }else {
                    return ['class' => 'success', 'id' =>'tr_'. $searchModel->id];
            }
              
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
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
                'value' => 'area0.name_ar',

            ],
            [
                'attribute' => 'nationality',
                'value' => 'nationality0.name_ar',

            ],

            [
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],

            [
                'attribute' => 'certificates',
                'value' => 'certificates',
                'format' => 'html',

            ],
            [
                'attribute' => 'experience',
                'value' => 'experience',
                'format' => 'html',

            ],
            [
                'attribute' => 'priorities',
                'value' => 'priorities',
                'format' => 'html',

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
                        default:
                            return Yii::t('app', 'NOT_INTERVIEWED');
                        }

                   
                },
                'filter' => [
                    RequastJobForm::NOT_INTERVIEWED  => Yii::t('app', 'NOT_INTERVIEWED'),
                    RequastJobForm::WAS_INTERVIEWED  => Yii::t('app', 'WAS_INTERVIEWED'),
                    RequastJobForm::IGNORAE  => Yii::t('app', 'IGNORAE'),
                    RequastJobForm::BUSY  => Yii::t('app', 'BUSY'),
                ],
                 

                'format' => 'html',
                'contentOptions' => function ($searchModel) {
                    return ['class' => 'class_action_' . $searchModel->id];
                }
            ],
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {Cv}{delete} {update} {sendwhatsapp} {msgwhatsapp}{action_user}',  // the default buttons + your custom button
            'buttons' => [
                  'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-view'),
                                    'class' => ''
                        ]);
                    },

                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-update'),
                                    'class' => ''
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                                    'class' => '',
                                    'data' => [
                                        'confirm' => 'are you sure to delete it.',
                                        'method' => 'post',
                                    ],
                        ]);
                    },
                'Cv' => function($url, $model, $key) {   
                      // render your custom button
                    return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],
                        ['class' => 'glyphicon glyphicon-th', 
                        'data-pjax' => 0]);
                },


                'msgwhatsapp' => function ($url, $model,$key) {
                    $url= "index.php?r=requast-job-form/msgwhatsapp&id=".$model->id;
                    return Html::button('' , ['value' => $url,
                        'title' => Yii::t('app', 'msgwhatsapp'),
                        'class' => 'msgwhatsapp  glyphicon glyphicon-envelope','data-pjax' => 0]);
                        
                },
                    'action_user' => function ($url, $model, $key) {
                        $url = "index.php?r=requast-job-form/action_user&id=" . $model->id;
                        return Html::button('', [
                            'value' => $url,
                            'title' => Yii::t('app', 'Action_User'),
                            'class' => 'action_user  glyphicon glyphicon-cog', 'data-pjax' => 0
                        ]);
                    },

                'sendwhatsapp' => function ($url, $model, $key)use($message) {     // render your custom button
                    $phone=substr($model->phone, 1);;
                    return  Html::a('', "https://api.whatsapp.com/send?phone=962$phone&text=$message",
                     ['target' => '_blank','class' => 'glyphicon glyphicon-envelope', 'data-pjax' => 0]);
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
    $.get("index.php?r=requast-job-form/plus&id="+id, function(data, status){
        var data = jQuery.parseJSON( data );
        $(".class_num_"+id).text( data.count );
    });
});

$(document).on('click', '#minusbutton', function(){
    id=$(this).attr('value');
    
    $.get("index.php?r=requast-job-form/minus&id="+id, function(data, status){
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

