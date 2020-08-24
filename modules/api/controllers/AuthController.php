<?php

namespace app\modules\api\controllers;

use app\modules\api\models\LoginFormRest;
use Yii;
use sizeg\jwt\Jwt;
use sizeg\jwt\JwtHttpBearerAuth;

class AuthController extends \yii\rest\Controller
{

      /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => JwtHttpBearerAuth::class,
            'optional' => [
                'login',
            ],
        ];

        return $behaviors;
    }



    public function actionLogin()
    {

        $model= new LoginFormRest();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->validate()){
                return $model->login();
            }else{
               
                return $model->errors;
            }
           
        } 
       
    }

  

}