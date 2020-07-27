<?php

namespace app\controllers;

use app\models\User;
use Yii;
use app\models\Admin;
use app\models\AdminSearch;
use app\models\UserMessage;
use app\models\UserMessageClarification;
use app\models\UserMessageMerchant;
use app\models\UserMessageZoom;
use Carbon\Carbon;
use Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AdminController implements the CRUD actions for Admin model.
 */
class AdminController extends BaseController
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
     * Lists all Admin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Admin model.
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
     * Creates a new Admin model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Admin();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $today = Carbon::now("Asia/Amman");
            $model->status= User::STATUS_ACTIVE;
            $model->type=User::NORMAL_ADMIN;
            $model->password_hash=\Yii::$app->security->generatePasswordHash(123456789);
            $model->save();
            
            $message_zoom = UserMessageZoom::find()->select('text')->column()[0];
            $msss_zoom_model = new UserMessageZoom();
            $msss_zoom_model->text = $message_zoom;
            $msss_zoom_model->user_id = $model->id;
            $msss_zoom_model->created_at = $today;
            $msss_zoom_model->updated_at = $today;


            $message_merchant = UserMessageMerchant::find()->select('text')->column()[0];
            $message_merchant_model = new UserMessageMerchant();
            $message_merchant_model->text = $message_merchant;
            $message_merchant_model->user_id = $model->id;
            $message_merchant_model->created_at = $today;
            $message_merchant_model->updated_at = $today;

            $message_clarification = UserMessageClarification::find()->select('text')->column()[0];
            $msss_clarification_model = new UserMessageClarification();
            $msss_clarification_model->text = $message_clarification;
            $msss_clarification_model->user_id =$model->id;
            $msss_clarification_model->created_at = $today;
            $msss_clarification_model->updated_at = $today;

            $message_user = UserMessage::find()->select('text')->column()[0];
            $message_user_model = new UserMessage();
            $message_user_model->text = $message_user;
            $message_user_model->user_id =$model->id;
            $message_user_model->created_at = $today;
            $message_user_model->updated_at = $today;

            
            $msss_zoom_model->save(false) ;
            $message_merchant_model->save(false) ;
            $msss_clarification_model->save(false) ;
            $message_user_model->save(false);
           
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Admin model.
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
     * Deletes an existing Admin model.
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
     * Finds the Admin model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Admin the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Admin::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
