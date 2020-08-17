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

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute' => 'area',
                'value' => function ($searchModel) {
                    return $searchModel->area0['name_ar'];
                },

            ],
           
            
            'expected_salary',
            [
                'attribute' => 'subscribe_date',
                'value' => 'subscribe_date',
                // 'filter' =>
                //     DatePicker::widget([
                //         'name' => 'subscribe_date',

                //         'pluginOptions' => [
                //             'autoclose'=>true,
                //             'format' => 'yyyy-mm-dd',
                            
                //         ]
                //     ]),

                'format' => 'html',
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
            'year_of_experience',
            [
                'attribute' => 'priorities',
                'value' => 'priorities',
                'format' => 'html',

            ],

            [
                'attribute' => 'note',
                'value' => 'note',
                'format' => 'html',

            ],

            [
                'attribute' => 'created_at',
                'label'=> Yii::t('app', 'Created_At'),
                'value'=> function($searchModel){
                    $now = Carbon::now("Asia/Amman");
                     $date = Carbon::parse(Carbon::parse($searchModel->created_at));
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
            'template' => '{view} {sendsms} {delete} {Cv} {update} {sendwhatsapp} {plus}{minus}{msgwhatsapp}{vedio}',  // the default buttons + your custom button
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
                                    'class' => 'btn btn-info'
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                    'title' => Yii::t('app', 'lead-delete'),
                                    'class' => 'btn btn-info'
                        ]);
                    },
                'Cv' => function($url, $model, $key) {   
                      // render your custom button
                    return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],['class' => 'btn btn-info glyphicon glyphicon-th', 'data-pjax' => 0]);
                },
                // 'printcv' => function($url, $model, $key) {     // render your custom button
                //     return  Html::a('CV', ['requast-job/print-cv', 'id' => $model->id],['class' => 'glyphicon glyphicon-print', 'data-pjax' => 0]);
                // },
                'sendsms' => function ($url, $model, $key) {     // render your custom button
                    return  Html::button('sendsms',  ['target' => '_blank','value'=>Url::to('index.php?r=requast-job/send-single-message&id='.$model->id),'class' => 'btn btn-info glyphicon glyphicon-envelope', 'id'=>"modelbutton",'data-pjax' => 0]);
                },
                'sendwhatsapp' => function ($url, $model, $key) use($message){     // render your custom button
                    $phone=substr($model->phone, 1);;
                    return  Html::a('whatsapp', "https://web.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank','class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]);
                },
                'plus' => function ($url, $model, $key) {     // render your custom button
                    return  Html::button('plus',  ['value' => $model->id, 'class' => 'btn btn-info glyphicon  glyphicon-plus', 'id' => "plusbutton", 'data-pjax' => 1]);
                },
                'minus' => function ($url, $model, $key) {     // render your custom button
                    return  Html::button('minus',  [ 'value' => $model->id, 'class' => 'btn btn-info glyphicon glyphicon-minus', 'id' => "minusbutton", 'data-pjax' => 1]);
                },
                
                'msgwhatsapp' => function ($url, $model,$key) {
                    $url="index.php?r=requast-job/msgwhatsapp&id=".$model->id;
                    return Html::button(' '.Yii::t('app', 'msgwhatsapp') , ['value' => $url,
                        'title' => Yii::t('app', 'msgwhatsapp'),
                        'class' => 'msgwhatsapp btn btn-info glyphicon glyphicon-envelope','data-pjax' => 0]);
                },
                'vedio' => function ($url, $model, $key) {
                    $is_upload_vedio='red';
                    if($model->vedio !== null){
                            $is_upload_vedio='green';  
                    }
                       
                        $url = "index.php?r=users/view-vedio&id=" . $model->id;
                        return Html::button('', [
                            'value' => $url,
                            'title' => Yii::t('app', 'View_Vedio'),
                            'class' => "view_vedio $is_upload_vedio  glyphicon glyphicon-play-circle", 'data-pjax' => 0
                        ]);

                    },
                
            ]
            ],
           
        ],
    ]); ?>

 
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

