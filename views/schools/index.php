<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SchoolsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Schools');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="container">
        
            <h1><?= Html::encode($this->title) ?></h1>

            <p>
                <?= Html::a(Yii::t('app', 'Create_Schools'), ['create'], ['class' => 'btn btn-success']) ?>
            </p>

            <?php Pjax::begin(); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); 
            ?>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'id',
                    'name',
                    [
                        'attribute' => 'phone',
                        'value' => function ($searchModel) {
                            return '<a href="tel:'.$searchModel->phone.'">'.$searchModel->phone.'</a>';
                        },
                        'format' => 'html',
                    ],
                    'email',
                    [
                        'attribute'=>'facebook',
                        'value'=>function($searchModel){
                            return substr($searchModel->facebook,0, 15);
                        },//substr(, 0, 15),
                    ],
                  
                    [
                        'attribute'=>'youtube',
                        'value'=>function($searchModel){
                            return substr($searchModel->youtube,0, 15);
                        },//substr(, 0, 15),
                    ],
                
                    [
                        'attribute'=>'twitter',
                        'value'=>function($searchModel){
                            return substr($searchModel->twitter,0, 15);
                        },//substr(, 0, 15),
                    ],
                  
                    [
                        'attribute'=>'address',
                        'value'=>function($searchModel){
                            return substr($searchModel->address,0, 15);
                        },//substr(, 0, 15),
                    ],
                    
                    [
                        'attribute'=>'location',
                        'value'=>function($searchModel){
                            return substr($searchModel->location,0, 15);
                        },//substr(, 0, 15),
                    ],
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->details,0, 15);
                        },//substr(, 0, 15),
                    ],
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->director_word,0, 15);
                        },//substr(, 0, 15),
                        
                    ],            
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->discounts_form,0, 15);
                        },
                    ],  
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->map,0, 15);
                        },
                    ],  
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->brochure,0, 15);
                        },
                    ],  
                    [
                        'attribute'=>'details',
                        'value'=>function($searchModel){
                            return substr($searchModel->contact_information,0, 15);
                        },
                    ],  
                    'path_logo',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
     