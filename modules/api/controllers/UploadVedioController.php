<?php


namespace app\modules\api\controllers;


use app\models\VedioUser;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadVedioController
{
    public  function actionIndex(){
        $model =  VedioUser::find()->where(['user_id'=>Yii::$app->user->identity->id])->one();

        if($model == null){
            $model =new VedioUser();
        }

        if ($model->load(Yii::$app->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {

                $id = Yii::$app->user->identity->id;
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
                Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Vedio'));
            }

            return $this->render('index', ['model' => $model]);
        }

    }

}