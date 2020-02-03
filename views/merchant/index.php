<?php

use app\models\UserMessage;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\MerchantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$dataModel=UserMessage::find()->where(['user_id'=>Yii::$app->user->id])->one();
$message=($dataModel==null)?'':$dataModel->text;
$this->title = Yii::t('app', 'Merchants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create_Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'phone',

           
        [
            'attribute' => 'area',
            'value' => 'governorate0.name_ar',

        ],
            [
                'attribute' => 'area',
                'value' => 'area0.name_ar',

            ],
            'note:ntext',
            'name_company',


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{delete} {update} {sendwhatsapp} ',  // the default buttons + your custom button
                'buttons' => [
                    'sendwhatsapp' => function ($url, $model, $key)use($message) {     // render your custom button
                        $phone=substr($model['phone'], 1);
                        return  Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank','class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]);
                    },


                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
