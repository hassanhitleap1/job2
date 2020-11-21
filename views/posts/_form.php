<?php

use app\models\Area;
use app\models\Categories;
use coderius\pell\Pell;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="container">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
        <?= $form->field($model, 'category_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Categories::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'area_id')->widget(Select2::classname(), [
                        'data' =>  ArrayHelper::map(Area::find()->all(), 'id', 'name_ar'),
                        'language' => 'ar',
                        'options' => ['placeholder' =>Yii::t('app',"Plz_Select")],
                       
                    ]); ?>
        </div>
        
    
    </div>           

    <div class="row">
        <div class="col-md-11">
            <?= $form->field($model, 'body')->widget(Pell::className(), []); ?>
        </div>
    </div>
    <div class="row">    
        
        <div class="col-md-3">
            <?= $form->field($model, 'accept')->checkBox([
                            'label' => Yii::t('app', 'Accept'), 'data-size' => 'small', 'class' => 'bs_switch', 'style' => 'margin-bottom:4px;', 'id' => 'active'
                        ]) ?>
        </div>
        
        <div class="col-md-3">
        <?= $form->field($model, 'show_number')->checkBox([
                            'label' => Yii::t('app', 'Show_Number'), 'data-size' => 'small', 'class' => 'bs_switch', 'style' => 'margin-bottom:4px;', 'id' => 'active'
                        ]) ?>
        </div>
    </div>       

   

    



    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
