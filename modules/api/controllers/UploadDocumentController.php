<?php


namespace app\modules\api\controllers;


use app\models\Document;
use app\models\RequastJobForm;
use app\models\User;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadDocumentController
{
        public  function actionIndex(){
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
                    $user->action_user=RequastJobForm::CONTRACT_WAS_SIGNED;
                    $user->type = User::NORMAL_USER;
                    $user->save(false);
                    Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Cont'));
                }

                return $this->render('index', ['model' => $model]);
            }

        }
}