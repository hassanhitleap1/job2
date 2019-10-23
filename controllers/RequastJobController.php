<?php

namespace app\controllers;

use app\models\CountSendSms;
use Yii;
use app\models\RequastJob;
use app\models\RequastJobSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * RequastJobController implements the CRUD actions for RequastJob model.
 */
class RequastJobController extends BaseController
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
        $searchModel = new RequastJobSearch();
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
        $model = new RequastJob();

        if ($model->load(Yii::$app->request->post())) {
           
            $file = UploadedFile::getInstance($model, 'file');
            if($model->validate()){
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

        if ($model->load(Yii::$app->request->post()) ) {
            $file = UploadedFile::getInstance($model, 'file');
            if($model->validate()){
                if(!is_null($file)){
                    $imagename='images/avatar/' . md5(uniqid(rand(), true)). '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar=$imagename;
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
     * Finds the RequastJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequastJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequastJob::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
