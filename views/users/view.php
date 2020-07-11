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



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        
            'name',
            'first_payment',
            [
                'format' => 'raw',
                'attribute' => 'gender',
                'value' => function ($model) {
                    if ($model->gender == User::MALE) {
                        return "ذكر";
                    } elseif ($model->gender == User::FEMALE) {
                        # code...
                        return "انثى";
                    } else {
                        return 'غير محدد';
                    }
                },
                'filter' => [0 => "غير محدد", User::MALE => " ذكر", User::FEMALE => " انثى"],


            ],
            'agree',
            'phone',
            [
                'format' => 'raw',
                'name' => 'governorate',
                'attribute' => 'governorate',
                'value' => $model->governorate0->name_ar,

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
            'expected_salary',   
            'priorities:ntext',
            'affiliated_with',
            'year_of_experience',
            
        ],
    ]) ?>

</div>

