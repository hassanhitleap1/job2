<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequastJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Suggested_Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
        <input  id=message-text" type="hidden" value="<?=$message?>">
        <input  id=marchent_id" type="hidden" value="<?=$merchant_id?>">

    <div  class="row">
        <div class="alert alert-success" id="success_message" style="display: none;" role="alert">
            succefully send message
        </div>
        <div class="alert alert-danger" id="error_message"   style="display: none;" role="alert">
            error the messge not saved
        </div>
        <div class="col-md-6">
            <div class="row">
                <h2><?= Yii::t('app', 'Users_Pay')?></h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?= Yii::t('app', 'Name')?></th>
                        <th><?= Yii::t('app', 'Area')?></th>
                        <th><?= Yii::t('app', 'Priorities')?></th>
                        <th><?= Yii::t('app', 'Action')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users_pay as $user_pay ):?>
                        <tr>
                            <td><?= $user_pay->name?></td>
                            <td><?= $user_pay->area?></td>
                            <td><?= $user_pay->priorities?></td>
                            <td>
                                <button id="send-message-suggested"  class="btn btn-primary float-right " ><?= Yii::t('app', 'Send')?></button>
                                <button id="save-message-suggested"  class="btn btn-primary float-right hidden" ><?= Yii::t('app', 'Save')?></button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="row">
                <h2><?= Yii::t('app', 'Users_Pay')?></h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><?= Yii::t('app', 'Name')?></th>
                        <th><?= Yii::t('app', 'Area')?></th>
                        <th><?= Yii::t('app', 'Priorities')?></th>
                        <th><?= Yii::t('app', 'Action')?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($users_not_pay as $user_not_pay ):?>
                        <tr>
                            <td><?= $user_pay->name?></td>
                            <td><?= $user_pay->area?></td>
                            <td><?= $user_pay->priorities?></td>
                            <td>
                                <button  id="btt_send_<?=$user_not_pay->id?>" user-id="<?=$user_not_pay->id?>" phone="<?=$user_not_pay->phone?>"  class="btn btn-primary float-right send-message-suggested" ><?= Yii::t('app', 'Send')?></button>
                                <button  id="btt_save_<?=$user_not_pay->id?>"  user-id="<?=$user_not_pay->id?>" phone="<?=$user_not_pay->phone?>"  class="btn btn-primary float-right save-message-suggested hidden" ><?= Yii::t('app', 'Save')?></button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


