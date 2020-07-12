<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\MessageJobUser;
use app\models\RequastJobNotPay;
use Yii;
use app\models\RequastJob;
use app\models\RequastJobNotPaySearch;
use app\models\SendSmsModel;
use app\models\User;
use app\models\UserMessage;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;
use yii\base\Model;

/**
 * RequastJobController implements the CRUD actions for RequastJob model.
 */
class RequastJobNotPayController extends BaseController
{

    /**
     * init controller
     */
    public function init()
    {
        if (Yii::$app->user->identity->type != User::ADMIN_USER || Yii::$app->user->identity->type != User::NORMAL_ADMIN ) {
            throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
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
     * Lists all RequastJob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequastJobNotPaySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequastJob model.
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
     * Creates a new RequastJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequastJobNotPay();

        if ($model->load(Yii::$app->request->post())) {
           
            $file = UploadedFile::getInstance($model, 'file');
            if($model->validate()){
                $model->pay_service=User::NOT_PAY_SERVICE;
                if(!is_null($file)){
                    $imagename='images/avatar/' . md5(uniqid(rand(), true)). '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar=$imagename;
                }
               
               if($model->save()){
                   $modelCountSendSms = new CountSendSms();
                   $modelCountSendSms->user_id=$model->id;
                   $modelCountSendSms->count=0;
                   $modelCountSendSms->save(false);
                    return $this->redirect(['view', 'id' => $model->id]);
               }

            }  
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequastJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $assigns_for=[];
        $assigns_to=[];
        if ($model->load(Yii::$app->request->post()) ) {
            $file = UploadedFile::getInstance($model, 'file');
            if($model->validate()){
                $model->pay_service=User::NOT_PAY_SERVICE;
                if(!is_null($file)){
                    $imagename='images/avatar/' . md5(uniqid(rand(), true)). '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar=$imagename;
                    // $assigns_for=$_POST["RequastJob"]["assigns_for"];
                    // $assigns_to=$_POST["RequastJob"]["assigns_to"];
                    
                }
               
               if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
               }

            }  
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing RequastJob model.
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
     * Displays a single RequastJob model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCv($id)
    {
        $this->layout = "cv-layout";
        return $this->render('cv', [
            'model' => $this->findModel($id),
        ]);
    }


        /**
     * Displays a single RequastJob model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionShowCv($id)
    {
        $this->layout = "cv-layout";
        return $this->render('show_cv', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single RequastJob model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSendSms($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->post())) { 
            exit;
        }
        return $this->render('send_sms', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionDoSendSms($id)
    {
        $model = $this->findModel($id);
        $phone = $model->phone;
        $isSend = Yii::$app->smscomponent->sendsmsforuser($phone);
        return $this->redirect(['index']);
    }
    
      
    


    public function actionPrintCv($id){
       
        $user=User::findOne($id);
        ConvertApi::setApiSecret('AvvRd4prGwWNUP7E');
        # Example of converting Web Page URL to PDF file
        # https://www.convertapi.com/web-to-pdf
        $fromFormat = 'web';
        $conversionTimeout = 180;
        $dir = 'Downloads';
        $result = ConvertApi::convert(
            'pdf',
            [
                'Url' =>    Url::base(). '/index.php?r=requast-job%2Fcv&id='.$id,
                'FileName' => 'cv_for'.$user->name
            ],
            $fromFormat,
            $conversionTimeout
        );
        
        $savedFiles = $result->saveFiles($dir);
        if($savedFiles){
            return $this->redirect(['index']);   
        }
          throw new Exception("لم يطبع السيره الذاتية", 1);
                     
               
    }
    /**
     * Finds the RequastJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequastJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequastJobNotPay::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


    public function actionSendSingleMessage($id){

        $model = new SendSmsModel();
      
        if ($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                exit;
                return $this->redirect(['index']);
            }
           
        }

        return $this->renderAjax('send-single-message', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new RequastJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPlus($id)
    {
       $model= CountSendSms::find()->where(['user_id'=> $id])->one();
       $model->count= $model->count +1;
       
       if($model->created_at==null){
        $model->created_at= Carbon::now("Asia/Amman");
       }
        $model->updated_at = Carbon::now("Asia/Amman");
       $model->save();
       header('Content-Type: application/json');
       $data["status"]=201;
       $data["count"]=$model->count;
       echo json_encode($data,JSON_PRETTY_PRINT);
       return ;
    }


    /**
     * Creates a new RequastJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionMinus($id)
    {
        $model = CountSendSms::find()->where(['user_id' => $id])->one();
        if ($model->count != 0) {
            $model->count = $model->count - 1;
            $model->updated_at = Carbon::now("Asia/Amman");
            $model->save();
        }
        
        header('Content-Type: application/json');
        $data["status"]=201;
        $data["count"]=$model->count;
        echo json_encode($data,JSON_PRETTY_PRINT);
        return ;
    }



        /**
     * @param $id
     */
    public function  actionMsgwhatsapp($id){
        $user = $this->findModel($id);
        $model=new MessageJobUser();
        $dataModel=UserMessage::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $message=($dataModel==null)?'':$dataModel->text;

        return $this->renderAjax('msgwhatsapp', [
            'model' => $model,
            'user'=>$user,
            'message'=>$message
        ]);
    }
    
    
}
