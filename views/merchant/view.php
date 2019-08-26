<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Merchant */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Merchants'), 'url' => ['index']];
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
        <?= Html::a(Yii::t('app', 'Create Merchant'), ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a(Yii::t('app', 'Back'), ['index'], ['class' => 'btn btn-info']) ?>
    </p>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            'name',
            'phone',
                [
                    'format' => 'raw',
                    'name' => 'area',
                    'attribute' => 'area',
                    'value' => $model->governorate0->name_ar,

                ],

            [
                'format' => 'raw',
                'name' => 'area',
                'attribute' => 'area',
                'value' => $model->area0->name_ar,

            ],
            'note:ntext',
            'name_company',

        ],
    ]) ?>

</div>