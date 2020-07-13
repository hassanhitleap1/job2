<?php

namespace app\controllers;

use app\models\Categories;
use app\models\CountSendSms;
use Yii;
use app\models\SendJob;
use app\models\SendJobSearch;
use app\models\SendSmsModel;
use app\models\User;
use Carbon\Carbon;
use Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SendJobController implements the CRUD actions for SendJob model.
 */
class SendJobController extends BaseController
{
    /**
     * init controller
     */
    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->type != User::ADMIN_USER) {
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
     * Lists all SendJob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SendJobSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SendJob model.
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
     * Creates a new SendJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SendJob();
        $catgories=Categories::find()->all();
        if ($model->load(Yii::$app->request->post())  ) {
            $modelCountSms = CountSendSms::find("user_id")->where(['<=','count_send_sms.count',30])->asArray()->all();
            $userIdArray = yii\helpers\ArrayHelper::getColumn($modelCountSms,'user_id');

            $query =(new \yii\db\Query())
                ->select(['phone','id'])
                ->from('user')
                ->where(['user.type'=>User::NORMAL_USER])
                ->where(['>=','user.subscribe_date',Carbon::now("Asia/Amman")->subDays(30)->toDateString()])
                ->where(['in', 'category_id', $userIdArray]);

                
            if($_POST["SendJob"]["all"]){
                $catgotiesSelected=$_POST["SendJob"]["category"];
                array_push($catgotiesSelected,0);
                $query->where(['in', 'category_id', $catgotiesSelected]);
            }

            $users=$query->all();

                $phones = ArrayHelper::getColumn($users, function ($element) {
                    return $element['phone'];
                });

                if(empty($phones)){
                    throw new NotFoundHttpException(Yii::t('app', 'No_Phone'));
                }

                $isSend=Yii::$app->smscomponent->sendsmsusingtwiz($phones);
                $userids = ArrayHelper::getColumn($users, function ($element) {
                    return $element['id'];
                });
                 CountSendSms::updateAllCounters(['count' => 1],['in','user_id',$userids]);
                if(!$isSend){
                    throw new NotFoundHttpException(Yii::t('app', 'Not_Send_Message'));
                }
                    
                
            if($model->validate()){
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
             
        }

        return $this->render('create', [
            'model' => $model,
            'catgories'=> $catgories
        ]);
    }

    /**
     * Updates an existing SendJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            var_dump($model->category[]);
            exit;

            if ($model->validate()) {


                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SendJob model.
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

    /**
     * Finds the SendJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SendJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SendJob::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionSendSingleMessage($id){

        $model = new SendSmsModel();
      
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                return $this->redirect(['requast-job/index']);
            }
           
        }

        return $this->renderAjax('send-single-message', [
            'model' => $model,
        ]);
    }
}
