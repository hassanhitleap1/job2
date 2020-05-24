<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\Governorate;
use app\models\Nationality;
use app\models\RequastJob;
use app\models\RequastJobGoogle;
use app\models\RequastJobNotPay;
use Yii;
use yii\web\Controller;
use app\models\RequastJobVisitor;
use yii\helpers\FileHelper;
use yii\web\Response;
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
                $id =Yii::$app->db->createCommand('SELECT id FROM 	user_from_google  ORDER BY id DESC LIMIT 1')
                    ->queryScalar();
                if($id==''){
                    $id=1;
                }
               
               
                if (!is_null($cv)) {
                    if(is_dir("cv_form/$id")){
                        rmdir("cv_form/$id");
                    }else{
                        FileHelper::createDirectory("cv_form/$id", $mode = 0775, $recursive = true);
                    }

                    $cvfullpath = "cv_form/$id/index" . '.' . $cv->extension;
                    $cv->saveAs($cvfullpath);
                }
               
                $modelForm->save(false);
              

                $modelCountSendSms = new CountSendSms();
                $modelCountSendSms->user_id=$modelForm->id;
                $modelCountSendSms->count=0;
                $modelCountSendSms->save(false);
                Yii::$app->session->setFlash('message', 'تم ارسال نموذج التقديم لوظيفة');
                
                return $this->render('index', [
                    'model' => $model,
                ]);
            }
        }
     

        return $this->render('index', [
            'model' => $model,
        ]);
      
    }

    public function  actionGetData(){
        $data['code']=201;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data['data']['nationality']=Nationality::find()->where(['!=', 'id', 1])->all();
        $data['data']['governorate']=Governorate::find()->all();
        return $data;
    }


  
}
