<?php

namespace app\controllers;

use app\models\CountSendSms;
use Yii;
use yii\web\Controller;
use app\models\RequastJobVisitor;
use yii\web\UploadedFile;

class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = "maintheme";
        
        $model = new RequastJobVisitor();
       
        if ($model->load(Yii::$app->request->post()) ) {
            $file = UploadedFile::getInstance($model, 'avatar');
            $cv = UploadedFile::getInstance($model, 'cv');
            if ($model->validate()) {
                 $data['name']=$model->name;
                 $data['agree']=$model->agree;
                  $data['phone']=$model->phone;
                  $data['nationality']=$model->nationality;
                  $data['certificates']=$model->certificates;
                  $data['experience']=$model->experience;
                  $data['governorate']=$model->governorate;
                  $data['area']=$model->area;
                  $data['expected_salary']=$model->expected_salary;
                if (!is_null($file)) {
                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                    $data["avatar"] = $imagename;
                }
                $id=1;
                if (!is_null($cv)) {
                    $cvfullpath = "cv/$id/index" . '.' . $file->extension;
                    $file->saveAs($cvfullpath);
                }
                  
                  Yii::$app->session->setFlash('success', 'send aplication sucessfuly');
                Yii::$app->db
                ->createCommand()
                ->batchInsert('requast_job', ['name','agree', 'phone','nationality','certificates','experience','governorate','expected_salary'],[$data])
                ->execute();
                $modelCountSendSms = new CountSendSms();
                $modelCountSendSms->user_id=$model->id;
                $modelCountSendSms->count=0;
                $modelCountSendSms->save(false);
                return $this->goHome();
            } 

          
        }

   
      
        return $this->render('index', [
            'model' => $model,
        ]);
      
    }

}
