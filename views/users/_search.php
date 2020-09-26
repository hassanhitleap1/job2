<?php

use app\models\NameOfJobs;
use kartik\select2\Select2;
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



    <div class="form-group">
        <div class="row">
            <div class="col-md-8">
                <?= $form->field($model, 'name_of_jobs_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(NameOfJobs::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select_Name_Of_Jobs")],
                       
                    ]); ?>

            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'favorite')->dropDownList(
                            [0 => Yii::t('app', 'UnFavorite'), 1 => Yii::t('app', 'Favorite')],
                            [
                                'prompt' => Yii::t('app',"All")
                            ]
                    ); ?>

            </div>
        
        </div>
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