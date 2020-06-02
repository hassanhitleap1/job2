<?php

namespace app\controllers;

use app\models\CountSendSms;
use app\models\Courses;
use app\models\Degrees;
use app\models\EducationalAttainment;
use app\models\Experiences;
use app\models\Governorate;
use app\models\LoginForm;
use app\models\Model;
use app\models\Nationality;
use app\models\RequastJob;
use app\models\RequastJobGoogle;
use app\models\RequastJobNotPay;
use app\models\User;
use Carbon\Carbon;
use Yii;
use yii\web\Controller;
use app\models\RequastJobVisitor;
use Exception;
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
        $experience='';
        $count_experience=0;
        $diff_dayes=0;
        $modelsCourses= [new Courses];
        $modelsExperiences= [new Experiences];
        $modelsEducationalAttainment= [new EducationalAttainment(['scenario' => EducationalAttainment::SCENARIO_REGISTER])];
//        $modelsEducationalAttainment->scenario = EducationalAttainment::SCENARIO_REGISTER;

        if ($model->load(Yii::$app->request->post())) {
            //_________________________________________________________________________
            $modelsCourses = Model::createMultiple(Courses::classname(),$modelsCourses );
            Model::loadMultiple($modelsCourses, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsExperiences = Model::createMultiple(Experiences::classname(),$modelsExperiences  );
            Model::loadMultiple($modelsExperiences, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsEducationalAttainment = Model::createMultiple(EducationalAttainment::classname(),$modelsEducationalAttainment  );
            Model::loadMultiple($modelsEducationalAttainment, Yii::$app->request->post());
            //___________________________________________________________________________

            // validate all models
            $valid = $model->validate() && Model::validateMultiple($modelsEducationalAttainment);

        //    $valid = Model::validateMultiple($modelsCourses) &&
        //        Model::validateMultiple($modelsExperiences) &&
        //        Model::validateMultiple($modelsEducationalAttainment) &&
        //        $valid ;
            
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
                            $experience .=
                                $modelsCourse->name_course. "  ".
                                $modelsCourse->destination ."  ".
                                $modelsCourse->duration .
                                "<br />";
                            $modelsCourse->user_id = $model->id;
                            if (!($flag = $modelsCourse->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }

                        foreach ($modelsExperiences as $modelsExperience) {
                            $experience .=
                                $modelsCourse->job_title. "  ".
                                ' من ' .$modelsCourse->month_from_exp.'-'.$modelsCourse->year_from_exp  ."  ".
                                ' الى '.$modelsCourse->month_to_exp.'-'.$modelsCourse->year_to_exp. "  ".
                                 ' في '.$modelsCourse->facility_name .
                                "<br />";
                            // format date 2019-10-26 15:48:41
                            $from = Carbon::parse($modelsCourse->year_to_exp.'-'.$modelsCourse->month_to_exp.'-'.'1');
                            $to = Carbon::parse($modelsCourse->year_from_exp.'-'.$modelsCourse->month_from_exp.'-'.'1');
                            $diff_dayes +=$from->diffInDays($to);

                            $modelsExperience->user_id = $model->id;
                            if (!($flag = $modelsExperience->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                        foreach ($modelsEducationalAttainment as $modelsEducationalAttainm) {
                            $experience .=
                                $modelsEducationalAttainm->specialization. "  ".
                                $modelsEducationalAttainm->university ."  ".
                                $modelsEducationalAttainm->year_get .
                                "<br />";

                            $modelsEducationalAttainm->user_id = $model->id;
                            if (!($flag = $modelsCourse->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    

                    if($diff_dayes !=0){
                        $count_experience= round($diff_dayes / 360, 1);
                    }else {
                        # code...
                        $count_experience= $diff_dayes;
                    }
                     
                    $model->year_of_experience= $count_experience;
                    $model->experience= $experience;
                    $model->save(false);

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

                $model_login = new LoginForm();
                $user = User::findByPhone($model->phone);

                $model_login->login_form($user);

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
