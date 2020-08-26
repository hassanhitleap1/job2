<?php


namespace app\modules\api\controllers;


use app\models\Document;
use app\models\RequastJobForm;
use app\models\User;
use app\modules\traits\ApiResponser;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadDocumentController extends  \yii\rest\Controller
{
    public $user;
    use ApiResponser;

    public function init()
    {
        $access_token=Yii::$app->request->headers['authorization'];
        $this->user=User::findIdentityByAccessToken($access_token);
    }



        public  function actionIndex(){


            $model = new Document();

             if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {

    
                $model->contract = UploadedFile::getInstance($model, 'contract');

                if ($model->validate()) {

                    $id = $this->user->id;
                    $folder_path = "contracts/$id";
                    FileHelper::removeDirectory($folder_path);
                    FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                    $contract = "$folder_path/contract" . "." . $model->contract->extension;
                    $model->contract->saveAs($contract);

                    $this->user->contract_path = $contract;
                    $this->user->action_user=RequastJobForm::CONTRACT_WAS_SIGNED;
                    $this->user->type = User::NORMAL_USER;
                    $this->user->save(false);
                    return $this->success_responce(["model"=>$model],Yii::t('app', 'Succ_Mess_Cont'));
                   
                }else{
                    return $this->errors_responce($model->errors);
                }

            
            }

        }
}