<?php

use app\models\MessageSchoolOwners;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\SchoolOwners */

$this->title = Yii::t('app', 'Update_School_Owners');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'School Owners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
$dataModel = MessageSchoolOwners::find()->where(['user_id' => Yii::$app->user->id])->one();
$message = ($dataModel == null) ? '' : $dataModel->text;
$phone= $model->phone;
?>
<div class="container">
    <p>
        <?= Html::a('whatsapp', "https://web.whatsapp.com/send?phone=962$phone&text=$message", ['target' => '_blank', 'class' => 'btn btn-info glyphicon glyphicon-envelope', 'data-pjax' => 0]); ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>