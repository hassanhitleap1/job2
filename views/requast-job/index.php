<?php

use app\models\User;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
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
            // 'certificates:ntext',
            // 'experience:ntext',
            [
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],
            [
                'attribute' => 'category_id',
                'value' => 'category0.name_ar',

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
            // 'note:ntext',
             [
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view} {update} {delete} {Cv} {printcv}',  // the default buttons + your custom button
            'buttons' => [
                'Cv' => function($url, $model, $key) {     // render your custom button
                    return  Html::a('Cv', ['requast-job/show-cv', 'id' => $model->id],['class' => 'glyphicon glyphicon-th', 'data-pjax' => 0]);
                },
                'printcv' => function($url, $model, $key) {     // render your custom button
                    return  Html::a('CV', ['requast-job/print-cv', 'id' => $model->id],['class' => 'glyphicon glyphicon-print', 'data-pjax' => 0]);
                }
            ]
            ],
           
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
