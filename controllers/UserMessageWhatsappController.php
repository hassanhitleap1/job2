<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\User;
use Yii;
use app\models\UserMessageWhatsapp;
use app\models\UserMessageWhatsappSearch;
use Carbon\Carbon;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserMessageWhatsappController implements the CRUD actions for UserMessageWhatsapp model.
 */
class UserMessageWhatsappController extends BaseController
{

    /**
     * init controller
     */
    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            if (!(Yii::$app->user->identity->type != User::ADMIN_USER || Yii::$app->user->identity->type != User::NORMAL_ADMIN)) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
        }
    }
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
     * Lists all UserMessageWhatsapp models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserMessageWhatsappSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single UserMessageWhatsapp model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new UserMessageWhatsapp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new UserMessageWhatsapp();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing UserMessageWhatsapp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing UserMessageWhatsapp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionSaveMessage()
    {
        $message= new UserMessageWhatsapp();
        $model= CountSendSms::find()->where(['user_id'=> $_POST["user_id"]])->one();
        $model->count= $model->count +1;
        
        if($model->created_at==null){
         $model->created_at= Carbon::now("Asia/Amman");
        }
         $model->updated_at = Carbon::now("Asia/Amman");
        $model->save();

        $message->test=$_POST["text"];
        $message->user_id=$_POST["user_id"];
        $message->marchent_id=$_POST["marchent_id"];
        $message->created_at=Carbon::now('Asia/Amman');
        $message->updated_at=Carbon::now('Asia/Amman');
        
        $data["code"]=401;
        $data["mesg"]="success";
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($message->save()){
            return $data;
           
        }
        $data["code"]=501;
        $data["mesg"]="filed";
        return ["ss"];
    }

    /**
     * Finds the UserMessageWhatsapp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserMessageWhatsapp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserMessageWhatsapp::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
