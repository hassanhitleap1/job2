<?php

use app\models\UserMessage;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RequastJobSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$dataModel=UserMessage::find()->where(['user_id'=>Yii::$app->user->id])->one();
$message=($dataModel==null)?'':$dataModel->text;
$this->title = Yii::t('app', 'Suggested_Jobs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1><?= Html::encode($this->title) ?></h1>
    <div  class="row">
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
                                <button id="send-message-suggested"  class="btn btn-primary float-right " ><?= Yii::t('app', 'Send')?></button>
                                <button id="save-message-suggested"  class="btn btn-primary float-right hidden" ><?= Yii::t('app', 'Save')?></button>
                            </td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


