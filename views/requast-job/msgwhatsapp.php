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
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php $form = ActiveForm::begin() ?>
        <div class="message" message="<?= $message?>"></div>
        <div class="row">
            <div class="col-md-12">
                <?=$form->field($model, 'user_id')->widget(Select2Widget::classname(),
                    [
                        'items' => ArrayHelper::map(User::find()->where(['type' => User::NORMAL_USER])->all(), 'id', 'name'),
                        'options' => ['placeholder' => 'Select Phone Number', 'value' =>$user->id ],
                    ]);
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'text')->textarea(['maxlength' => true,'id'=>'message-text']) ?>
            </div>
        </div>




        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-primary btn-lg btn-block']) ?>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>

    </div>
</div>
    </div>
