<?php


namespace app\controllers;

use Yii;
use app\models\RequastJobVisitor;
use app\models\VedioUser;
use Vimeo\Vimeo;
use yii\base\Controller;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

class UploadVedioController extends  BaseController
{
    /**
     * @vewi and upload vedio to site in local
     * @return string
     */
    public function actionIndex(){

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
                $model->file->saveAs($path);
                $model->path = $path;
                $model->save(false);
                Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Cont'));
            }

            return $this->render('index', ['model' => $model]);
        }


        return $this->render('index',['model'=>$model]);

    }


    /**
     * @do upload vedio form vimo
     * @throws \Vimeo\Exceptions\VimeoRequestExceptio
     * @throws \Vimeo\Exceptions\VimeoUploadException
     */
    public  function uploadVedioVimo(){
        $client = new Vimeo("739c3d54792b380bfde66acae2273e3ef2ab8382",
            "sON7Y3QJ4v8CFeO/cWmvw5PsmmruERT22AY4yErEiTPkcjUl6crFEmu5gTQwYe8mChaE08mjglUhAOZFS9TnNBNFB+wo0SljQTyo4G3IDtbARPPe4VtXEwcnY5itc2Gv",
            "ee953a1df4d937f188b2c3f0a2082d74");

        $file_name = \Yii::getAlias('@webroot')."/upload_vedio/1.mp4";
        $uri = $client->upload($file_name, array(
            "name" => "Untitled",
            "description" => "The description goes here."
        ));
        echo "Your video URI is: " . $uri;

//        $response = $client->request('/tutorial', array(), 'GET');
//        print_r($response);
        exit();

        $lib = new Vimeo("739c3d54792b380bfde66acae2273e3ef2ab8382",
            "sON7Y3QJ4v8CFeO/cWmvw5PsmmruERT22AY4yErEiTPkcjUl6crFEmu5gTQwYe8mChaE08mjglUhAOZFS9TnNBNFB+wo0SljQTyo4G3IDtbARPPe4VtXEwcnY5itc2Gv");

        $file_name = \Yii::getAlias('@webroot')."/upload_vedio/1.mp4";
        $uri = $lib->upload($file_name, array(
            "name" => "Untitled",
            "description" => "The description goes here."
        ));
        echo "Your video URI is: " . $uri;
        $response = $lib->request('/tutorial', array(), 'GET');
        print_r($response);
    }
}