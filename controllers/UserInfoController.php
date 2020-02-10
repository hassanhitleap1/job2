<?php

namespace app\controllers;

use app\models\User;
use yii\base\Response;

class UserInfoController extends \yii\web\Controller
{
    public function actionIndex()
    {
    
        
        $data=User::find($_GET['id'])->one();
        
        header('Content-Type: application/json');
        echo json_encode($data,JSON_PRETTY_PRINT);
        $data= json_encode($data,JSON_PRETTY_PRINT);
        print_r($data);
         return $data;
    }

}
