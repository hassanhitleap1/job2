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


	<!-- Heading -->
    <div id="heading" >
				<h1><?= Html::encode($this->title) ?></h1>
	</div>
    <section id="main" class="wrapper">
				<div class="inner">
					<div class="content">
                        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                        <div class="row">
                                <div class="col-6 col-12-xsmall">                  
                                        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label(Yii::t('app', 'Username'))  ?>
                                </div>
                                <div class="col-6 col-12-xsmall">           
                                    <?= $form->field($model, 'password')->passwordInput()->label(Yii::t('app', 'Password'))  ?>       

                                </div>
                                <div class="col-6 col-12-xsmall">
                                    <?= $form->field($model, 'rememberMe')->checkbox()->label(Yii::t('app', 'Remember_Me')) ?>
                                </div>
                        </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-12-xsmall"> 
                                <div class="form-group">
                                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'button primary', 'name' => 'login-button']) ?>
                                </div>
                            </div>
                        </div>
                        <?php ActiveForm::end(); ?>

                    </div>
				</div>
			</section>
</div>

   