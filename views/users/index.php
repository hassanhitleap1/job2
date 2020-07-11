<?php

use app\models\RequastJobForm;
use app\models\User;
use app\models\UserMessage;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;

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
                    return ['id'=> 'tr_' . $searchModel->id];
            }else {
                    return [ 'id' =>'tr_'. $searchModel->id];
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
            
            [
                'attribute' => 'area',
                'value' => function ($searchModel) {
                    return $searchModel->area0['name_ar'];
                },

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
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {Cv}',  // the default buttons + your custom button
            'buttons' => [
                 
                'Cv' => function($url, $model, $key) {   
                      // render your custom button
                    return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],
                        ['class' => 'glyphicon glyphicon-th', 
                        'data-pjax' => 0]);
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

