<?php

use app\models\Area;
use app\models\RequastJobForm;
use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$this->title = Yii::t('app', 'Requast_Job_Form');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'=>['style'=>"overflow-x: auto"],
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

                'filter' =>Select2::widget([
                    'name' => 'area',
                    "value"=>(isset($_GET['area']))?$_GET['area']:null,
                    'data' => ArrayHelper::map(Area::find()->where(['<>', 'id', 1])->all(), 'id', 'name_ar'),
                    'options' => [
                        'placeholder' => 'Select provinces ...',
                        'multiple' => false
                    ],
                ]),

                'format' => 'html',
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
                'attribute' => 'year_of_experience',
                'value' =>  function($searchModel){
                    if($searchModel->favoritel != null){
                        return  $searchModel['year_of_experience'].' <span class="star glyphicon glyphicon-star" user_id="'.$searchModel->id.'"></span>';
                    }else{
                        return  $searchModel['year_of_experience'].'  <span class="star glyphicon glyphicon-star-empty"  user_id="'.$searchModel->id.'"></span>';
                    }
                  
                },
                'format' => 'html',

            ],
        
            [
                'attribute' => 'priorities',
                'value' => 'priorities',
                'format' => 'html',

            ],
            [
                'attribute' => 'is_upload',
                'value' => function($searchModel){
                   if($searchModel->vedio !== null) {
                        
                        return 'تم الرفع';
                   } else {
                       
                        return "لم يتم ارفع";
                        
                    }

                },
                'filter' =>[0=>"لم يتم الرفع",1=>"تم الرفع"],
                'format' => 'html',
            ] ,
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {Cv}{vedio}',  // the default buttons + your custom button
            'buttons' => [
                 
                'Cv' => function($url, $model, $key) {   
                      // render your custom button
                    return  Html::a('Cv', ['users/show-cv', 'id' => $model->id],
                        ['class' => 'glyphicon glyphicon-th', 
                        'data-pjax' => 0]);
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

    <?php Pjax::end(); ?>
 
  

    <?php

    Modal::begin([
        'id'     => 'model',
        'size'   => 'model-lg',
    ]);

    echo "<div id='modelContent'></div>";

    Modal::end();

    ?>

</div>

