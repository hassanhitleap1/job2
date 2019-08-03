<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\RequestMerchant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Request_Merchants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
        <?= Html::a(Yii::t('app', 'Request_Merchants'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'name',
            'name_company',
            'phone',
            'avg_agree',
            'job_title',
            'desc_job:ntext',
            'area',
            'avg_salary',
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
                'value' => $model->nationality0->name_ar,

            ],
            'number_of_houer',
            'note',
        ],
    ]) ?>

</div>