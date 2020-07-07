<?php

namespace app\controllers;

use app\models\User;
use app\models\UserMessage;
use Yii;
use app\models\RequestMerchant;
use app\models\RequestMerchantSearch;
use yii\db\Query;
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

        $query = new Query();
        $query->select(   'request_merchant.id as id,
                    job_title,
                    desc_job,
                    request_merchant.created_at,
                    user.name,
                    user.phone,
                    area.name_ar as area')
                ->from('request_merchant')
                ->leftJoin('user', 'user.id = request_merchant.user_id')
                ->leftJoin('area', 'user.area = area.id');
                if(isset($_GET['search'])){
                    $search=$_GET['search'];
                    $query->where(['like', 'job_title', '%'.$search . '%', false])
                        ->orWhere(['like', 'desc_job','%'.$search . '%', false])
                        ->orWhere(['like', 'user.name','%'.$search . '%', false])
                        ->orWhere(['like', 'area.name_ar', '%' . $search . '%', false]);

                }
                $query->orderBy(['request_merchant.created_at'=>SORT_DESC])->limit(20);

            $rows = $query->all();
        return $rows;





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
     * @param $id
     */
    public function  actionSuggestedJobs($id){
        $request_merchant = $this->findModel($id);
        $job_title=$request_merchant->job_title;
        $phone_merchant=$request_merchant['marchent']['phone'];
        $merchant_id=$request_merchant['marchent']['id'];
        $query_users_pay = User::find();
        $query_users_pay->where(['type' => User::NORMAL_USER]);
        $query_users_pay->andWhere(['pay_service' => User::PAY_SERVICE]);
        $query_users_pay->andFilterWhere(['like', 'priorities', $job_title]);
        $query_users_pay->limit(20);
        $query_users_pay->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending
        ]);

        $users_pay=$query_users_pay->all();

        $query_users__not_pay = User::find();
        $query_users__not_pay->where(['type' => User::NORMAL_USER]);
        $query_users__not_pay->andWhere(['pay_service' => User::NOT_PAY_SERVICE]);
        $query_users__not_pay->andFilterWhere(['like', 'priorities', $job_title]);
        $query_users__not_pay->limit(20);
        $query_users__not_pay->orderBy([
            'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending
        ]);
        $users_not_pay=$query_users__not_pay->all();

        $dataModel=UserMessage::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $message=($dataModel==null)?'':$dataModel->text;
        $message =str_replace("",$job_title,$message);
        $message =str_replace("phone",$phone_merchant);
        $message =str_replace("job",$job_title);
        return $this->renderAjax('suggestedjobs', [
            'request_merchant' => $request_merchant,
            'users_pay'=>$users_pay,
            'users_not_pay'=>$users_not_pay,
            'message'=>$message,
            'merchant_id'=>$merchant_id,
        ]);
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
