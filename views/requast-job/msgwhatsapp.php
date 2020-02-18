<?php

use app\models\User;
use Carbon\Carbon;
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
        <div class="users"></div>
        <button id="save-message"  class="btn btn-primary float-right hidden" ><?= Yii::t('app', 'Save')?></button>
        <h3 id="marchent_id" ></h3>
        <h3 id="user-name"><?= Html::encode($this->title) ?></h3>
        <div class="alert alert-success" id="success_message" style="display: none;" role="alert">
            succefully send message
        </div>
        <div class="alert alert-danger" id="error_message"   style="display: none;" role="alert">
                error the messge not saved
        </div>
 
        <?php $form = ActiveForm::begin() ?>
        <div class="row">
        
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <div class="form-group">
                        <a href="#" class="btn btn-primary" id="send-message"><?= Yii::t('app', 'Send')?></a>
                    </div>
            </div>
         
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2" >
                <h3><?= Yii::t('app','Priorities')?></h3>
                <div id="priorities">
                <?= $user->priorities	?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Area')?></h3>
                <div id="area-user">
                <?= $user->area	?>
                </div>
            </div>
            <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
                <h3><?= Yii::t('app', 'Experience')?></h3>
                <div id="experience-user">
                <?= $user->experience	?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app', 'Nationality')?></h3>
                <div id="nationality-user">
                <?= $user->nationality0->name_ar	?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Gender')?></h3>
                <div id="gender-user">
                    <?php
                      if ($user->gender == User::MALE) {
                        echo "ذكر";
                    } elseif ($user->gender == User::FEMALE) {
                        # code...
                        echo "انثى";
                    } else {
                        echo 'غير محدد';
                    }
                    ?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Coun_Send_Sms')?></h3>
                <div id="coun-send-sms-user">
                <?= $user->smssend->count	?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Agree')?></h3>
                <div id="agree-user">
                <?= $user->agree	?>
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Created_At')?></h3>
                <div id="created-at-user">
                 <?php 
                 $now = Carbon::now("Asia/Amman");
                 $date = Carbon::parse(Carbon::parse($user->created_at));
                 $def=$date->diffInDays($now);
                 echo  "سجلت قبل ". $def . " يوم";
                 ?>   
                </div>
            </div>
            <div class="col-xs-1 col-sm-1 col-md-1 col-lg-1">
                <h3><?= Yii::t('app','Phone')?></h3>
                <div id="phone-user" >
                <?= $user->phone	?>
                </div>
            </div>

            
            
            
            
        </div>
        <div class="message" message="<?= $message?>"></div>
        
        <div  id="#phone-for" message="<?= $user->phone?>"></div>
       
        <div class="row">
            <div class="col-md-2">
                <label for="add-user"> اضغط  لاضافة المستخدم</label>
                <a id="add-user"  class="btn btn-primary" ><?= Yii::t('app', 'Add')?></a>
            </div>
            <div class="col-md-10">

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
                
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col"><?= Yii::t('app','Name_Merchant')?></th>
                            <th scope="col"><?= Yii::t('app','Area')?></th>
                            <th scope="col"><?= Yii::t('app','Job_Title')?></th>
                            <th scope="col"><?= Yii::t('app','Desc_Job')?></th>
                            <th scope="col"><?= Yii::t('app','Phone')?></th>
                            <th scope="col"><?= Yii::t('app','Created_At')?></th>
                        </tr>
                    </thead>
                    <tbody class="suggesstion-box">
                    </tbody>
                    </table>
                
                 
            </div>

        </div>

        
        <?php ActiveForm::end(); ?>

    </div>
</div>
    </div>
