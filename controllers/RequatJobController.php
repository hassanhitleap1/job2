<?php

namespace app\controllers;

use app\models\CountSendSms;
use Yii;
use yii\web\Controller;
use app\models\RequastJobVisitor;


class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $model = new RequastJobVisitor();

        if ($model->load(Yii::$app->request->post()) ) {
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
