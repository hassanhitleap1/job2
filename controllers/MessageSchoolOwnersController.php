<?php
namespace app\controllers;

use app\models\MessageSchoolOwners;
use app\models\User;
use Yii;
use Carbon\Carbon;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * UserMessageController implements the CRUD actions for UserMessage model.
 */
class MessageSchoolOwnersController extends Controller
{

    /**
     * init controller
     */
    public function init()
    {
        if (!(Yii::$app->user->identity->type != User::ADMIN_USER || Yii::$app->user->identity->type != User::NORMAL_ADMIN)) {
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
     * Lists all UserMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new  MessageSchoolOwners();

        if ($model->load(Yii::$app->request->post()) ) {
            $dataModel= MessageSchoolOwners::find()->where(['user_id'=>Yii::$app->user->id])->one();
            if($dataModel == null){
                $model->user_id=Yii::$app->user->id;
                $model->created_at=Carbon::now('Asia/Amman');
                $model->save();
            }else{
                $dataModel->text=$model->text;
                $dataModel->updated_at=Carbon::now('Asia/Amman');
                $dataModel->save();

            }

          
            return $this->redirect(['index']);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }





    /**
     * Finds the UserMessage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserMessage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MessageSchoolOwners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
