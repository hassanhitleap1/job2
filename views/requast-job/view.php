<?php

use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a(Yii::t('app', 'Create_Request_Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?>

        <?php $phone = substr($model->phone, 1);?>
        <?= Html::a('whatsapp', "https://api.whatsapp.com/send?phone=962$phone&text=شكرا لتعاملكم مع جرس للخدمات الوجستية نود اعلامكم عن توفر وظيفة    '     '  لدى مؤسسة للاستفسار الاتصال على الرقم التالي", ['target' => '_blank', 'class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]); ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            [
                'format' => 'raw',
                'attribute' => 'gender',
                'value' => function($model){
                       if($model->gender == User::MALE){
                           return "ذكر";
                       }elseif ($model->gender == User::FEMALE)  {
                            # code...
                             return "انثى";
                       }else{
                            return 'غير محدد';
                       }
                        
                },
                'filter' =>[0=>"غير محدد", User::MALE=>" ذكر", User::FEMALE=>" انثى"],


            ],
            'agree',
            'phone',
            [
            'format' => 'raw',
            'name' => 'governorate',
            'attribute'=> 'governorate',
            'value'=> $model->governorate0->name_ar,
            
            ],
            [
                'format' => 'raw',
                'name' => 'nationality',
                'attribute' => 'nationality',
                'value' => $model->nationality0['name_ar'],

            ],
            'certificates:ntext',
            'experience:ntext',
            [
                'format' => 'raw',
                'name' => 'governorate',
                'attribute' => 'governorate',
                'value' => $model->governorate0['name_ar'],

            ],
            [
                'format' => 'raw',
                'name' => 'category_id',
                'attribute' => 'category_id',
                'value' => $model->category0['name_ar'],

            ],
            'expected_salary',
            'subscribe_date',
            'note:ntext',
            'affiliated_with',
            'affiliated_to',
            'interview_time',
            'year_of_experience',
            [
                'format' => 'raw',
                'name' => 'counsendsms',
                'attribute' => 'counsendsms',
                'value' => $model->smssend['count'],

            ],
        ],
    ]) ?>

</div>