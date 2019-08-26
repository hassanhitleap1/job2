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


    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?= Yii::t('app', 'Job_Title'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Salary_From'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Salary_To'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Agree_From'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Agree_To'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Governorate'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Area'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Nationality'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Number_Of_Houer'); ?></th>
                    <th scope="col"><?= Yii::t('app', 'Note'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($model->requasts as $requast) : ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $requast->job_title ?></td>
                    <td><?= $requast->salary_from ?></td>
                    <td><?= $requast->salary_to ?></td>
                    <td><?= $requast->agree_from ?></td>
                    <td><?= $requast->agree_to ?></td>
                    <td><?= $requast->governorate0->name_ar ?></td>
                    <td><?= $requast->area0->name_ar ?></td>
                    <td><?= $requast->nationality0->name_ar ?></td>
                    <td><?= $requast->number_of_houer ?></td>
                    <td><?= $requast->note ?></td>

                </tr>
                <?php $i++; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>