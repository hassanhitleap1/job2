<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Admins');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Admin'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'name',
            'auth_key',
            'password_hash',
            //'password_reset_token',
            //'email:email',
            //'status',
            //'agree',
            //'phone',
            //'nationality',
            //'certificates:ntext',
            //'experience:ntext',
            //'governorate',
            //'area',
            //'expected_salary',
            //'note:ntext',
            //'type',
            //'name_company',
            //'auth_token',
            //'subscribe_date',
            //'avatar',
            //'gender',
            //'affiliated_to',
            //'affiliated_with',
            //'interview_time',
            //'year_of_experience',
            //'created_at',
            //'updated_at',
            //'verification_token',
            //'category_id',
            //'pay_service',
            //'priorities:ntext',
            //'first_payment',
            //'work_tolerance',
            //'teamwork',
            //'work_permanently',
            //'communication_skills',
            //'verification_email:email',
            //'action_user',
            //'contract_path',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
