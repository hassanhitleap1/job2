<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\EducationalAttainmentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Educational_Attainment');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'options'=>['style'=>"overflow-x: auto"],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

          
            [
                'attribute' => 'user_id',
                'value' => function ($searchModel) {

                    return $searchModel->user0["name"] ;
                }
            ],
            'specialization',
            'university',
            'year_get',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
