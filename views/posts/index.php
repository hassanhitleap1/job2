<?php

use app\models\Posts;
use app\models\User;
use Carbon\Carbon;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PostsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Posts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Post'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            [
                'attribute' => 'body',
                'value' => function($searchModel){
                    return     substr( $searchModel->body, 0, 50)." <a>More</a>";
                 },
                'format' => 'raw',
            ],
            
            [
                'attribute' => 'category_id',
                'value' => 'category.name_ar',

            ],
    
            [
                'attribute' => 'accept',
                'value' => function($searchModel){
                        if ($searchModel->accept) {
                            return "موافق عليه";
                        } else {
                            # code...
                            return "غير موافق عليه";
                        } 
                  
                },
                'filter' =>[null=>"غير محدد", Posts::Accept=>"موافق عليه", Posts::NonAccept=>"غير موافق عليه"],

                'format' => 'html',

            ],
            
        
            [
                'attribute' => 'country_id',
                'value' => 'country.name_ar',

            ],
        
            [
                'attribute' => 'region_id',
                'value' => 'region.name_ar',

            ],
        
            [
                'attribute' => 'area_id',
                'value' => 'area.name_ar',

            ],
        

            [
                'attribute' => 'show_number',
                'value' => function($searchModel){
                        if ($searchModel->show_number) {
                            return "عرض الرقم ";
                        } else {
                            # code...
                            return "عدم عرض الرقم";
                        } 
                  
                },
                'filter' =>[null=>"غير محدد", Posts::ShowNmber=>"عرض الرقم", Posts::NonShowNmber=>"عدم عرض الرقم"],

                'format' => 'html',

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
                'template' => '{view}  {delete} {update}',  // the default buttons + your custom button
               
                'buttons' => [
                      'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('app', 'lead-view'),
                                        'class' => ''
                            ]);
                        },
    
                        'update' => function ($url, $model) {
                            if(User::is_admin_user()){
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('app', 'lead-update'),
                                        'class' => ''
                            ]);
                            }
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
                
                  
                ]
                ],
               
            ],
        ]); ?>

    <?php Pjax::end(); ?>

</div>
