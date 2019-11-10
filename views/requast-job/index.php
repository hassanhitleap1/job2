<?php

use app\models\User;
use kartik\date\DatePicker;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequastJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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
            'certificates:ntext',
            'experience:ntext',
            // 'note:ntext',

            [
                'attribute' => 'counsendsms',
                'value' => 'smssend.count',

            ],
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {sendsms} {delete} {Cv} {update}    {sendwhatsapp}',  // the default buttons + your custom button
            'buttons' => [
                'Cv' => function($url, $model, $key) {     // render your custom button
                    return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],['class' => 'glyphicon glyphicon-th', 'data-pjax' => 0]);
                },
                // 'printcv' => function($url, $model, $key) {     // render your custom button
                //     return  Html::a('CV', ['requast-job/print-cv', 'id' => $model->id],['class' => 'glyphicon glyphicon-print', 'data-pjax' => 0]);
                // },
                'sendsms' => function ($url, $model, $key) {     // render your custom button
                    return  Html::button('sendsms',  ['target' => '_blank','value'=>Url::to('index.php?r=requast-job/send-single-message&id='.$model->id),'class' => 'glyphicon glyphicon-envelope', 'id'=>"modelbutton",'data-pjax' => 0]);
                },
                'sendwhatsapp' => function ($url, $model, $key) {     // render your custom button
                    $phone=substr($model->phone, 1);;
                    return  Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=شكرا لتعاملكم مع جرس للخدمات الوجستية نود اعلامكم عن توفر وظيفة    '     '  لدى مؤسسة للاستفسار الاتصال على الرقم التالي", ['target' => '_blank','class' => 'glyphicon glyphicon-envelope', 'data-pjax' => 0]);
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

JS;
$this->registerJs($script);
?>

<?php
        Modal::begin([
            'header'=>'<h4 id="modalHeader">send sms</h4>',
            'id'=>'model',
            'size'=>'model-lg'
            ]);
        echo '<div id="modelcontent"></div>';
        Modal::end();
    ?>

</div>

