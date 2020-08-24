<?php

namespace app\controllers;

use app\models\FavoriteUsers;
use app\models\RateUsers;
use Yii;

use Carbon\Carbon;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class RateUsersController extends BaseController
{


    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pages models.
     * @return mixed
     */
    public function actionSave()
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
    
}
