<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\Courses;
use app\models\Degrees;
use app\models\EducationalAttainment;
use app\models\Experiences;
use app\models\Governorate;
use app\models\Model;
use app\models\Nationality;
use app\models\RequastJob;
use app\models\RequastJobGoogle;
use app\models\RequastJobNotPay;
use app\models\User;
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

        $modelsCourses= [new Courses];
        $modelsExperiences= [new Experiences];
        $modelsEducationalAttainment= [new EducationalAttainment];

        if ($model->load(Yii::$app->request->post())) {
            //_________________________________________________________________________
            $modelsCourses = Model::createMultiple(Courses::classname(),$modelsCourses  );
            Model::loadMultiple($modelsCourses, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsExperiences = Model::createMultiple(Experiences::classname(),$modelsExperiences  );
            Model::loadMultiple($modelsExperiences, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsEducationalAttainment = Model::createMultiple(EducationalAttainment::classname(),$modelsEducationalAttainment  );
            Model::loadMultiple($modelsEducationalAttainment, Yii::$app->request->post());
            //___________________________________________________________________________

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsCourses) &&
                Model::validateMultiple($modelsExperiences) &&
                Model::validateMultiple($modelsEducationalAttainment) &&
                $valid ;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::NORMAL_USER;
                $file = UploadedFile::getInstance($model, 'avatar');
                $image_file = UploadedFile::getInstance($model, 'cv');
                if (!is_null($file)) {
                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar = $imagename;
                }
                if (!is_null($image_file)) {
                    $imagename = 'images/1/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                }
                try {
                    if ($flag = $model->save()) {
                        foreach ($modelsCourses as $modelsCourse) {
                            $modelsCourse->user_id = $model->id;
                            if (!($flag = $modelsCourse->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsExperiences as $modelsExperience) {
                            $modelsExperience->user_id = $model->id;
                            if (!($flag = $modelsExperience->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsEducationalAttainment as $modelsEducationalAttainm) {
                            $modelsEducationalAttainm->user_id = $model->id;
                            if (!($flag = $modelsCourse->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $modelCountSendSms = new CountSendSms();
                        $modelCountSendSms->user_id=$model->id;
                        $modelCountSendSms->count=0;
                        $modelCountSendSms->save(false);
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('index', [
            'model' => $model,
            'modelsCourses' => (empty($modelsCourses)) ? [new Courses] : $modelsCourses,
            'modelsExperiences' => (empty($modelsExperiences)) ? [new Experiences] : $modelsExperiences,
            'modelsEducationalAttainment' => (empty($modelsEducationalAttainment)) ? [new EducationalAttainment] : $modelsEducationalAttainment,
        ]);
     

      
    }

    public function  actionGetData(){
        $data['code']=201;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data['data']['nationality']=Nationality::find()->where(['!=', 'id', 1])->all();
        $data['data']['governorate']=Governorate::find()->all();
        $data['data']['degrees']=Degrees::find()->all();

        return $data;
    }


  
}
