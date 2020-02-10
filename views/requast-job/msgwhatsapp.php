<?php

use app\models\User;
use yii\widgets\ActiveForm;
use conquer\select2\Select2Widget;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\RequastJob */

$this->title = $user->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Requast_Jobs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


?>
    <div class="">
        <h3 id="user-name"><?= Html::encode($this->title) ?></h3>
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
        
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                      <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                      <a href="#" class="btn btn-primary btn-lg  btn-block"><?= Yii::t('app', 'Send')?></a>
                </div>
            </div>
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4" id="priorities">
                <?= $user->priorities	?>
            </div>
        </div>
        <div class="message" message="<?= $message?>"></div>
        <div class="row">
            <div class="col-md-12">
                <?=$form->field($model, 'user_id')->widget(Select2Widget::classname(),
                    [
                        'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_USER])->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select Phone Number', 'value' =>$user->id ,'id'=>'user-id'],
                    ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'text')->textarea(['maxlength' => true,'id'=>'message-text']) ?>
                <div class="list-group suggesstion-box">
                 
                </div>
            </div>

        </div>

        
        <?php ActiveForm::end(); ?>

    </div>
</div>
    </div>
