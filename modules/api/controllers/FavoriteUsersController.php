<?php


namespace app\modules\api\controllers;

use Yii;
use app\modules\traits\ApiResponser;
use app\models\FavoriteUsers as FavoriteUser ;
use yii\filters\auth\QueryParamAuth;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class FavoriteUsersController extends   \yii\rest\Controller
{
        use ApiResponser;


        /**
       * @inheritdoc
       */
    //   public function behaviors()
    //   {
         
    //       return ArrayHelper::merge(parent::behaviors(), [
    //           'Authorization' => [
    //               'class'=> QueryParamAuth:: className (), // Implementing access token authentication
    //           ]
    //       ]);
    //   }
  

      /**
       * 
       */
      public function actionIndex()
      {

        return "action index";
        $model= new FavoriteUser();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->validate()){
                return $this->success_responce(["model"=>$model]);
            }else{
               return $this->errors_responce($model->errors);
            
            }
           
        } 
       
    }

}