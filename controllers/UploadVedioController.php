<?php


namespace app\controllers;


use Vimeo\Vimeo;
use yii\base\Controller;

class UploadVedioController extends  Controller
{
    public function actionIndex(){


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