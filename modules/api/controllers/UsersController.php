<?php


namespace app\modules\api\controllers;

use Yii;
use app\models\User;
use app\modules\traits\ApiResponser;


class UsersController extends   \yii\rest\Controller
{

        public $user;
        use ApiResponser;

        public function init()
        {
            $access_token=Yii::$app->request->headers['authorization'];
            $this->user=User::findIdentityByAccessToken($access_token);
        }

        public function actionMoreInfo(){
         return $this->success_responce(["users"=>$this->user]);
        }
}