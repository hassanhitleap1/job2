<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Admin */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Admins'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-view">

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
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'name',
            'auth_key',
            'password_hash',
            'password_reset_token',
            'email:email',
            'status',
            'agree',
            'phone',
            'nationality',
            'certificates:ntext',
            'experience:ntext',
            'governorate',
            'area',
            'expected_salary',
            'note:ntext',
            'type',
            'name_company',
            'auth_token',
            'subscribe_date',
            'avatar',
            'gender',
            'affiliated_to',
            'affiliated_with',
            'interview_time',
            'year_of_experience',
            'created_at',
            'updated_at',
            'verification_token',
            'category_id',
            'pay_service',
            'priorities:ntext',
            'first_payment',
            'work_tolerance',
            'teamwork',
            'work_permanently',
            'communication_skills',
            'verification_email:email',
            'action_user',
            'contract_path',
        ],
    ]) ?>

</div>
