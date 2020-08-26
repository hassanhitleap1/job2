<?php


namespace app\modules\api\controllers;

use app\models\User;
use app\models\VedioUser;
use app\modules\traits\ApiResponser;
use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadVedioController extends  \yii\rest\Controller
{
    public $user;
    use ApiResponser;

    public function init()
    {
        $access_token=Yii::$app->request->headers['authorization'];
        $this->user=User::findIdentityByAccessToken($access_token);
    }


    public  function actionIndex(){
        $model =  VedioUser::find()->where(['user_id'=>$this->user->id])->one();

        if($model == null){
            $model =new VedioUser();
        }

        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '')) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {

                $id = $this->user->id;
                $folder_path = "upload_vedio/$id";
                FileHelper::removeDirectory($folder_path);
                FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                $path = "$folder_path/index" . "." . $model->file->extension;
                $model->user_id=$id;
                $model->status=VedioUser::ACTIVE;
                $model->name_of_jobs_id=$model->name_of_jobs_id;
                $model->file->saveAs($path);
                $model->path = $path;
                $model->save(false);
                return $this->success_responce(["model"=>$model],Yii::t('app', 'Succ_Mess_Vedio'));
  
            }else{
                return $this->errors_responce($model->errors);
            }

           
        }

    }

}