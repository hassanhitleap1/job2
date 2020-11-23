<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title) ?>
        </div>
        <div class="panel-body">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <div class="row">
                            <div class="col-lg-12">
                            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app', 'Email_Or_Phone'))  ?>
                            <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password'))  ?>
                            <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app', 'Remember_Me')) ?>
                                <div class="form-group">
                                    <?php echo Html::a(Yii::t('app','Forgot_Password'), ['site/forget-password'])?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary ', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>
        </div>
       <div class="panel-footer">
           <div class="row">
            <div class="col-md-3">
                     <?php echo Html::a(Yii::t('app','Create_Requast_Job'), ['site/forget-password'])?>
               </div>
             <div class="col-md-3">
                    <?php echo Html::a(Yii::t('app','SignUpAdvertiser'), ['site/sign-up-advertiser'])?> 
              </div>
    
           </div>
            
        </div>
    </div>

   
