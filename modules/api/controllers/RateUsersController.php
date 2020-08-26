<?php


namespace app\modules\api\controllers;


use app\models\RateUsers;
use Carbon\Carbon;

class RateUsersController
{
    public function actionIndex()
    {
        $id=-1;
        $rate=1;
        if(isset($_GET['user_id'])){
            $id=$_GET['user_id'];
        }

        if(isset($_GET['rate'])){
            $rate=$_GET['rate'];
        }


        if (($model = RateUsers::find()->where(['user_id'=>$id])->andWhere(['merchant_id'=>Yii::$app->user->identity->id])->one() ) !== null) {
            $model->rate=$rate;
            $model->save();

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model ;
        }else{
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new RateUsers;
            $model->user_id=$id;
            $model->merchant_id  =Yii::$app->user->identity->id;
            $model->rate=$rate;
            $model->date  =Carbon::now("Asia/Amman");
            $model->save();
            return $model ;
        }
    }


    public function actionGetRate(){

    }
}