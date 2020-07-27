<?php

namespace app\controllers;

use app\models\User;


class UserInfoController extends BaseController
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
