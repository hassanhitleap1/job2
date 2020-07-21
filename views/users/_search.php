<?php

use app\models\NameOfJobs;
use app\models\Specialties;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\VedioUserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="vedio-user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'name_of_jobs_id')->widget(
        Select2Widget::className(),
        [
            'items' => ArrayHelper::map(NameOfJobs::find()->all(), 'id', 'name_ar')
        ]
    ); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php


    $this->registerJs(

        '$("document").ready(function(){ 
            
        $("#userssearch-specialtie_id").on("click", function() {
          
            $.pjax.reload({container:"#countries"});  //Reload GridView

        });

    });'

    );
    ?>
    <?php ActiveForm::end(); ?>

</div>