<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\RequastJobGoogle;
use app\models\RequastJobGoogleSearch;
use Yii;
use app\models\RequastJob;
use app\models\RequastJobNotPay;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * RequastJobController implements the CRUD actions for RequastJob model.
 */
class RequastJobGoogleController extends BaseController
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
     * Lists all RequastJob models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequastJobGoogleSearch();
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
     * Finds the RequastJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequastJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequastJobGoogle::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }


       /**
     * Deletes an existing RequastJob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMoveModel($id)
    {
       $model= $this->findModel($id);
       
       $modelForm= new RequastJobNotPay();
       $modelForm->name=$model->name;
       $modelForm->agree=$model->agree;
       $modelForm->gender=$_POST['radio'];
       $modelForm->phone=$model->phone;
       $modelForm->nationality=$model->nationality;
       $modelForm->certificates=$model->certificates;
       $modelForm->experience=$model->experience;
       $modelForm->governorate=$model->governorate;
       $modelForm->area=$model->area;
       $modelForm->expected_salary=$model->expected_salary;
       $modelForm->save(false);
              

       $modelCountSendSms = new CountSendSms();
       $modelCountSendSms->user_id=$modelForm->id;
       $modelCountSendSms->count=0;
       $modelCountSendSms->save(false);
       Yii::$app->session->setFlash('message', 'تم ارسال نموذج التقديم لوظيفة');
       
        return $this->redirect(['index']);
    }
}