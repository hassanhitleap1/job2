<?php

namespace app\controllers;

use app\models\Categories;
use Yii;
use app\models\SendJob;
use app\models\SendJobSearch;
use app\models\User;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * SendJobController implements the CRUD actions for SendJob model.
 */
class SendJobController extends BaseController
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
            $catgotiesSelected=$_POST["SendJob"]["category"];
            $users=(new \yii\db\Query())
                ->select(['phone'])
                ->from('user')
                ->where(['in', 'category_id', $catgotiesSelected])
                ->where(['user.type'=>User::NORMAL_USER])
                ->all();

                $phones = ArrayHelper::getColumn($users, function ($element) {
                    return $element['phone'];
                });
                
                var_dump($phones);
                exit;
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
}
