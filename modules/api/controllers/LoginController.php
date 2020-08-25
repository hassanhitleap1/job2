<?php

namespace app\modules\api\controllers;

use Yii;
use app\modules\api\models\LoginFormRest;
use app\modules\traits\ApiResponser;

class LoginController extends \yii\rest\Controller
{
    use ApiResponser;

    public function actionIndex()
    {

        $model= new LoginFormRest();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->validate()){
                return $this->success_responce(["token"=>$model->login()]);
            }else{
               return $this->errors_responce($model->errors);
            
            }
           
        } 
       
    }


    
  

}