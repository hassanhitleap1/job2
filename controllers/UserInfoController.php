<?php

namespace app\controllers;

use app\models\User;
use yii\base\Response;

class UserInfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $data=User::findOne($_GET['id']);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
         return $data;
    }

}
