<?php

namespace app\controllers;

use app\models\PostApply;
use Yii;
use app\models\Posts;
use yii\base\Controller;



/**
 * PostsController implements the CRUD actions for Posts model.
 */
class ApplayController extends Controller
{

    public function actionIndex()
    {
        $id=-1;
        if(isset($_GET['id'])){
            $id=$_GET['id'];
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $data=[];
        if (Yii::$app->user->isGuest) {
            $data=['code'=>401,'massage'=>Yii::t('app','Must_Be_Login')];
            return $data;
        }else{
         $count_applay=PostApply::find()->where(['user_id'=>Yii::$app->user->id])
                        ->andWhere(['post_id'=>$id])->count();

        if($count_applay){
            $data=['code'=>402,'massage'=>Yii::t('app','Yor_Applayed')];
            return $data;
        }else{
            $model= new PostApply();
            $model->user_id=Yii::$app->user->id;
            $model->post_id=$id;
            $model->save();
            $data=['code'=>201,'massage'=>Yii::t('app','Successfuly_Applay')];
            return $data;
        }


        }
    }

        

    }

   
  