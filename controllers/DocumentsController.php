<?php

namespace app\controllers;


use app\models\RequastJobForm;
use Yii;

use app\models\Document;
use app\models\RequastJobVisitor;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class DocumentsController extends BaseController
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
     * Lists all Area models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new Document();
        if ($model->load(Yii::$app->request->post())) {
            $user = $this->findModel(Yii::$app->user->identity->id);
            $model->contract = UploadedFile::getInstance($model, 'contract');
            
            if ($model->validate()) {
            
                $id = Yii::$app->user->identity->id;
                $folder_path = "contracts/$id";
                FileHelper::removeDirectory($folder_path);
                FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                $contract = "$folder_path/contract" . "." . $model->contract->extension;
                $model->contract->saveAs($contract);
                $user->contract_path = $contract;
                $user->action_user=RequastJobForm::CCONTRACT_WAS_SIGNED;
                $user->save(false);
                Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Cont'));
            }
          
            return $this->render('index', ['model' => $model]);
        }


        return $this->render('index',['model'=>$model]);
    }


    /**
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequastJobVisitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
  

}
