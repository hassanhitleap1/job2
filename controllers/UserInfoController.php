<?php

namespace app\controllers;

use app\models\User;
use yii\base\Response;

class UserInfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $user=User::findOne($_GET['id']);
        $data['user']=$user;
        $data['message_count']=$user->smssend->count;
        $data['nationality']=$user->nationality0['name_ar'];
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         return $data;
    }

}
