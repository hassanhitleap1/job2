<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'Plz_Enter_Email');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
            <?php $form = ActiveForm::begin(['id' => 'form-email', 'enableClientValidation' => true, 'enableAjaxValidation' => false,
                'action' => ['/email-validator/index'],
                'options' => ['enctype' => 'multipart/form-data']]); ?>
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= Html::input('submit', '0'); ?>

            <?php ActiveForm::end(); ?>


        </div>
    </div>



    <script type="text/javascript">
        $('#form-email').on('beforeSubmit', function(e) {

            var form = $(this);

            var formData = form.serialize();

            $.ajax({

                url: form.attr("action"),

                type: form.attr("method"),

                data: formData,

                success: function (data) {
                    if(data.code==401){
                        $('#model').modal('hide');


                    }else {
                        $("#model").html(data.content);
                    }

                },

                error: function () {

                    alert("Something went wrong");

                }

            });

        }).on('submit', function(e){

            e.preventDefault();

        });

    </script>