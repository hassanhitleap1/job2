<?php

namespace app\controllers;

use Yii;
use app\models\RequestMerchant;
use app\models\RequestMerchantSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * RequestMerchantController implements the CRUD actions for RequestMerchant model.
 */
class RequestMerchantController extends BaseController
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
     * Lists all RequestMerchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequestMerchantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single RequestMerchant model.
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
     * Creates a new RequestMerchant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new RequestMerchant();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing RequestMerchant model.
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
     * Deletes an existing RequestMerchant model.
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
     * filter api
     * @return mixed
     */
    public function actionFilter()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $requst_marchents = RequestMerchant::find()
            ->select(['id','job_title','desc_job']);
       if(isset($_GET['search'])){
           $search=$_GET['search'];
           $requst_marchents->where(['like', 'job_title', '%'.$search . '%', false])
               ->where(['like', 'desc_job','%'.$search . '%', false]);

       }
       $requst_marchents=$requst_marchents->limit(12)->all();

       return $requst_marchents;
    }


    public function actionGetRequest($id)
    {
        $data=[];
        $requst_marchent=RequestMerchant::findOne($id);
        $marchent=$requst_marchent->user0;
        $data['marchent']=$marchent;
        $data['requst_marchent']=$requst_marchent;
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if($requst_marchent ==null){
            $data=[];
        }
         return $data;
    }



    /**
     * Finds the RequestMerchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return RequestMerchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequestMerchant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
