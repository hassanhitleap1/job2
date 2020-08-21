<?php

namespace app\controllers;

use app\models\FavoriteUsers;
use Yii;

use app\models\User;
use Carbon\Carbon;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PagesController implements the CRUD actions for Pages model.
 */
class FavoriteUsersController extends BaseController
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
        if(isset($_GET['user_id'])){
            $id=$_GET['user_id'];
        }
        
        
        if (($model = FavoriteUsers::find()->where(['user_id'=>$id])->andWhere(['merchant_id'=>Yii::$app->user->identity->id])->one() ) !== null) {
            $model->delete();

            
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return $model ;
        }else{
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model = new FavoriteUsers;
            $model->user_id=$id;
            $model->merchant_id  =Yii::$app->user->identity->id;
            $model->date  =Carbon::now("Asia/Amman");
            $model->save();
            return $model ;
        }
    }
    
}
