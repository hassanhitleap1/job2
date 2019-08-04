<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\RequestMerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Request_Merchants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Request_Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'job_title',
            'desc_job:ntext',
            'salary_from',
            'salary_to',
            'agree_from',
            'agree_to',
            [
                'attribute' => 'governorate',
                'value' => 'governorate0.name_ar',

            ],
            'area',
            'number_of_houer',
            [
                'attribute' => 'nationality',
                'value' => 'nationality0.name_ar',

            ],
            'note:ntext',
            [
                'attribute' => 'user_id',
                'value' => 'user0.name',

            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
