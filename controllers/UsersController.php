<?php

namespace app\controllers;

use Yii;
use app\models\ActionAdmin;
use app\models\CountSendSms;
use app\models\MessageJobUser;
use app\models\RequastJobForm;
use app\models\UsersSearch;
use app\models\UserMessage;
use app\models\RequastJob;
use app\models\SendSmsModel;
use app\models\User;
use app\models\VedioUser;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Exception;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\UploadedFile;


/**
 * RequastJobController implements the CRUD actions for RequastJob model.
 */
class UsersController extends BaseController
{

    public $allow=[
        User::ADMIN_USER ,
        User::NORMAL_ADMIN,
        User::MERCHANT_USER
    ];
    /**
     * init controller
     */
    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            if (!in_array(Yii::$app->user->identity->type, $this->allow)) {
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
                    'forgot-password' => ['POST'],

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
        $searchModel = new UsersSearch();
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
        $model = new RequastJobForm();

        if ($model->load(Yii::$app->request->post())) {
           
            $file = UploadedFile::getInstance($model, 'file');
            if($model->validate()){
                if(!is_null($file)){
                    $imagename='images/avatar/' . md5(uniqid(rand(), true)). '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar=$imagename;
                }
                $model->type=User::FORM_APPLAY_USER;
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
        \Yii::$app
        ->db
            ->createCommand()
            ->delete('experiences', ['user_id' => $id])
            ->execute();
        \Yii::$app
        ->db
            ->createCommand()
            ->delete('educational_attainment', ['user_id' => $id])
            ->execute();
        \Yii::$app
        ->db
            ->createCommand()
            ->delete('courses', ['user_id' => $id])
            ->execute();

        $model_action= new ActionAdmin();
        $model_action->user_id=$id;
        $model_action->admin_id=Yii::$app->user->identity->id;
        $model_action->action=Yii::t('app',"Delete_User");
        $model_action->save(false);
      
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionForgotPassword($id){
        $model=$this->findModel($id);
        $model->password_hash=\Yii::$app->security->generatePasswordHash('123456789');
        $model->save(false);
        $model_action= new ActionAdmin();
        $model_action->user_id=$id;
        $model_action->admin_id=Yii::$app->user->identity->id;
        $model_action->action=Yii::t('app',"Change_Password");
        $model_action->save(false);
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
        if (($model = RequastJobForm::findOne($id)) !== null) {
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
     * Creates a new RequastJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionChangeAction($id)
    {
        $model = $this->findModel($id);
        $action = '';
        $action_id = -1;
        
        if (isset($_GET)) {
            switch ($_GET['action_user']) {
                case RequastJobForm::NOT_INTERVIEWED:
                    $model->action_user = RequastJobForm::NOT_INTERVIEWED;
                    $action_id = RequastJobForm::NOT_INTERVIEWED;
                    $action = Yii::t('app', 'NOT_INTERVIEWED');
                    break;
                case RequastJobForm::WAS_INTERVIEWED:
                    $model->action_user = RequastJobForm::WAS_INTERVIEWED;
                    $model->type = User::NORMAL_USER;
                    $action_id = RequastJobForm::WAS_INTERVIEWED;
                    $action = Yii::t('app', 'WAS_INTERVIEWED');
                    break;
                case RequastJobForm::IGNORAE:
                    $model->action_user = RequastJobForm::IGNORAE;
                    $model->type = User::NORMAL_USER_IGNORAE;
                    $action_id = RequastJobForm::IGNORAE;
                    $action = Yii::t('app', 'IGNORAE');
                    break;
                case RequastJobForm::BUSY:
                    $model->action_user = RequastJobForm::BUSY;
                    $action_id = RequastJobForm::BUSY;
                    $action = Yii::t('app', 'BUSY');
                    break;
                case RequastJobForm::CONTRACT_WAS_SIGNED;
                    $model->action_user = RequastJobForm::CONTRACT_WAS_SIGNED;
                    $action_id = RequastJobForm::CONTRACT_WAS_SIGNED;
                    $action = Yii::t('app', 'CONTRACT_WAS_SIGNED');
                    break;
                default:
                    $model->action_user = RequastJobForm::NOT_INTERVIEWED;
                    $action_id = RequastJobForm::NOT_INTERVIEWED;
                    $action = Yii::t('app', 'NOT_INTERVIEWED');
            }
        }

        $model_action = new ActionAdmin();
        $model_action->user_id = $id;
        $model_action->admin_id = Yii::$app->user->identity->id;
        $model_action->action = $action;
        $model_action->save(false);
        $data["status"] = 401;
        $data["action"] = $action;
        $data["action_id"] = $action_id;
        $data["id"] = $id;
        if ($model->save(false)) {
            $data["status"] = 201;
        }
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $data;
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


    /**
     * @param $id
     */
    public function  actionAction_user($id)
    {
        $model = $this->findModel($id);
        
        $dataModel = UserMessage::find()->where(['user_id' => Yii::$app->user->id])->one();
        $message = ($dataModel == null) ? '' : $dataModel->text;
        return $this->renderAjax('action_user', [
            'model' => $model,
            'message' => $message
        ]);
    }


    /**
     * Creates a new RequastJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionSaveNoteAffiliated($id)
    {
        $model = $this->findModel($id) ;
        $model->note=$_POST["note"];
        $model->affiliated_with = $_POST["affiliated_with"];
        $model->save(false);
        $model_action= new ActionAdmin();
        $model_action->user_id=$id;
        $model_action->admin_id=Yii::$app->user->identity->id;
        $model_action->action=Yii::t('app','Change_Note_To').' '.' '.$model->note;
        $model_action->save(false);
        
        header('Content-Type: application/json');
        $data["status"] = 201;
        echo json_encode($data, JSON_PRETTY_PRINT);
        return;
    }



    /**
     * Displays a single VedioUser model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionViewVedio($id)
    {
        
        if (($model = VedioUser::find()->where(['user_id' => $id])->one()) !== null) {
            return $this->renderAjax('view-vedio', [
                'model' => $model,
            ]);
        }

        return $this->renderAjax('view-vedio-not-found', [
            'model' => RequastJobForm::findOne($id),
        ]);
       
    }
}
