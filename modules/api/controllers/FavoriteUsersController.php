<?php


namespace app\modules\api\controllers;

use Yii;
use app\modules\traits\ApiResponser;
use app\models\FavoriteUsers as FavoriteUser ;
use Carbon\Carbon;
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
        $model= new FavoriteUser();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            if($model->validate()){
                $id=-1;
                if(isset($_POST['user_id'])){
                    $id=$_POST['user_id'];
                }
                if (($model = FavoriteUser::find()->where(['user_id'=>$id])->andWhere(['merchant_id'=>Yii::$app->user->identity->id])->one() ) !== null) {
                    $model->delete();
                }else{
                   
                    $model = new FavoriteUser;
                    $model->user_id=$id;
                    $model->merchant_id  =Yii::$app->user->identity->id;
                    $model->date  =Carbon::now("Asia/Amman");
                    $model->save();
                    
                }
                return $this->success_responce(["model"=>$model]);
            }else{
               
               return $this->errors_responce($model->errors);
            
            }
        
        } 
       
    }

}