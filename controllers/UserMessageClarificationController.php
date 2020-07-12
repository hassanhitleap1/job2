<?php
namespace app\controllers;

use app\models\User;
use app\models\UserMessageClarification;
use Yii;
use Carbon\Carbon;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * UserMessageController implements the CRUD actions for UserMessage model.
 */
class UserMessageClarificationController extends BaseController
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
     * Lists all UserMessage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new  UserMessageClarification();

        if ($model->load(Yii::$app->request->post()) ) {
            $dataModel=UserMessageClarification::find()->where(['user_id'=>Yii::$app->user->id])->one();
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
        if (($model = UserMessageClarification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
