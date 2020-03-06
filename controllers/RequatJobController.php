<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\RequastJobGoogle;
use Yii;
use yii\web\Controller;
use app\models\RequastJobVisitor;
use yii\web\UploadedFile;
use  yii\web\Session;

class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = "maintheme";
        
        $model = new RequastJobVisitor();
       
        if ($model->load(Yii::$app->request->post())){
            $file = UploadedFile::getInstance($model, 'avatar');
            $cv = UploadedFile::getInstance($model, 'cv');
            if ($model->validate()) {
                $modelForm= new RequastJobGoogle();
                $modelForm->name=$model->name;
                $modelForm->agree=$model->agree;
                $modelForm->gender=$_POST['radio'];
                $modelForm->phone=$model->phone;
                $modelForm->nationality=$model->nationality;
                $modelForm->certificates=$model->certificates;
                $modelForm->experience=$model->experience;
                $modelForm->governorate=$model->governorate;
                $modelForm->area=$model->area;
                $modelForm->expected_salary=$model->expected_salary;
                if (!is_null($file)) {
                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                    $modelForm->avatar= $imagename;
                }
                $id =Yii::$app->db->createCommand('SELECT id FROM user_from_google ORDER BY id DESC LIMIT 1')
                    ->queryScalar();
                if($id==''){
                    $id=1;
                }

                if (!is_null($cv)) {
                    if(is_dir("cv_form/$id")){
                        rmdir("cv_form/$id");
                    }else{
                        mkdir("cv_form/$id");
                    }
                    $cvfullpath = "cv_form/$id/index" . '.' . $file->extension;
                    $file->saveAs($cvfullpath);
                }
               
                $modelForm->save();

                $modelCountSendSms = new CountSendSms();
                $modelCountSendSms->user_id=$modelForm->id;
                $modelCountSendSms->count=0;
                $modelCountSendSms->save(false);
                Yii::$app->session->setFlash('success', 'send aplication sucessfuly');
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }

        return $this->render('index', [
            'model' => $model,
        ]);
      
    }


    /*
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

                $id =Yii::$app->db->createCommand('SELECT id FROM user_from_google ORDER BY id DESC LIMIT 1')
                    ->queryScalar();

                if (!is_null($cv)) {
                    if(is_dir("cv_form/$id")){
                        rmdir("cv_form/$id");
                    }else{
                        mkdir("cv_form/$id");
                    }
                    $cvfullpath = "cv_form/$id/index" . '.' . $file->extension;
                    $file->saveAs($cvfullpath);
                }

                Yii::$app->session->setFlash('success', 'send aplication sucessfuly');
                Yii::$app->db
                ->createCommand()
                ->batchInsert('user_from_google', ['name','agree', 'phone','nationality','certificates','experience','governorate','expected_salary'],[$data])
                ->execute();

                return $this->render('index', [
                    'model' => $model,
                ]);
                $modelCountSendSms = new CountSendSms();
                $modelCountSendSms->user_id=$model->id;
                $modelCountSendSms->count=0;
                $modelCountSendSms->save(false);
                return $this->goHome();
            }
        }
     */
}
