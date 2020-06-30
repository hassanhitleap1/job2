<?php

namespace app\controllers;

use Carbon\Carbon;
use Yii;
use app\models\UserMessageZoom;
use app\models\UserMessageZoomSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserMessageZoomController implements the CRUD actions for UserMessageZoom model.
 */
class UserMessageZoomController extends BaseController
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
     * Lists all UserMessageZoom models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model=new UserMessageZoom();
        if ($model->load(Yii::$app->request->post()) ) {
            $dataModel=UserMessageZoom::find()->where(['user_id'=>Yii::$app->user->id])->one();
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
     * Finds the UserMessageZoom model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserMessageZoom the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserMessageZoom::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
