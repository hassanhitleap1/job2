<?php

namespace app\controllers;
use Yii;
use app\models\CountSendSms;
use app\models\Courses;
use app\models\EducationalAttainment;
use app\models\Experiences;
use app\models\LoginForm;
use app\models\Model;
use app\models\User;
use Carbon\Carbon;
use app\models\RequastJobVisitor;
use Exception;


class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = "maintheme";
        
        $model = new RequastJobVisitor();
        $experience='';
        $count_experience=0;
        $diff_dayes=0;
        $certificate='';
        $modelsCourses= [new Courses];
        $modelsExperiences= [new Experiences];
        $modelsEducationalAttainment= [new EducationalAttainment(['scenario' => EducationalAttainment::SCENARIO_REGISTER])];


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
            $model->username =null;
            $model->password_hash=Yii::$app->security->generatePasswordHash($model->password);
            $model->email=null;
            $model->status=User::STATUS_ACTIVE;
            $model->expected_salary=0;
            $model->note='';
            $model->name_company='';
            $model->subscribe_date=null;
            // validate all models
            $valid = $model->validate() && Model::validateMultiple($modelsEducationalAttainment);

        //    $valid = Model::validateMultiple($modelsCourses) &&
        //        Model::validateMultiple($modelsExperiences) &&
        //        Model::validateMultiple($modelsEducationalAttainment) &&
        //        $valid ;


            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::NORMAL_USER;
//                $file = UploadedFile::getInstance($model, 'avatar');
//                $image_file = UploadedFile::getInstance($model, 'cv');
//                if (!is_null($file)) {
//                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
//                    $file->saveAs($imagename);
//                    $model->avatar = $imagename;
//                }
//
//                if (!is_null($image_file)) {
//                    $imagename = 'images/1/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
//                    $file->saveAs($imagename);
//                }

                try {

                    if ($flag = $model->save(false)) {
                        foreach ($_POST['Courses'] as $modelCourse) {
                            $model_course =new Courses();
                            $model_course->name_course=$modelCourse['name_course'];
                            $model_course->destination=$modelCourse['destination'];
                            $model_course->duration=$modelCourse['duration'];
                            // if($modelCourse->name_course != null){
                                $certificate .=
                                    $modelCourse['name_course']. "  ".
                                    $modelCourse['destination'] ."  ".
                                    $modelCourse['duration'] .
                                    "<br />";
                                $model_course->user_id = $model->id;
                                if (!($flag = $model_course->save(false))) {
                                    $transaction->rollBack();
                                    break;
                                }
                           // }

                        }
                      
                        foreach ($modelsExperiences as $modelsExperience) {

                            if ($modelsExperience->year_to_exp != null) {
                                $experience .=
                                    $modelsExperience->job_title. "  ".
                                    ' من ' .$modelsExperience->month_from_exp.'-'.$modelsExperience->year_from_exp  ."  ".
                                    ' الى '.$modelsExperience->month_to_exp.'-'.$modelsExperience->year_to_exp. "  ".
                                    ' في '.$modelsExperience->facility_name .
                                    "<br />";
                                // format date 2019-10-26 15:48:41
                                
                                $from = Carbon::parse(strval($modelsExperience->year_to_exp) . '-' . strval($modelsExperience->month_to_exp) . '-' . '1');
                                $to = Carbon::parse(strval($modelsExperience->year_from_exp) . '-' . strval($modelsExperience->month_from_exp) . '-' . '1');
                                $diff_dayes += $from->diffInDays($to);
                                
                               
                                $modelsExperience->user_id = $model->id;
                                if (!($flag = $modelsExperience->save(false))) {
                                    $transaction->rollBack();
                                    
                                    break;
                                }
                             
                           }

                        }

                        foreach ($modelsEducationalAttainment as $modelsEducationalAttainm) {
                            $experience .=
                                $modelsEducationalAttainm->specialization. "  ".
                                $modelsEducationalAttainm->university ."  ".
                                $modelsEducationalAttainm->year_get .
                                "<br />";

                            $modelsEducationalAttainm->user_id = $model->id;
                            if (!($flag = $modelsEducationalAttainm->save(false))) {
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
                    $model->certificates=$certificate;
                    $model->save(false);

                    if ($flag) {
                        $modelCountSendSms = new CountSendSms();
                        $modelCountSendSms->user_id=$model->id;
                        $modelCountSendSms->count=0;
                        $modelCountSendSms->save(false);
                        $transaction->commit();
                        $model_login = new LoginForm();
                        $user = User::findByPhone($model->phone);
                        $model_login->login_form($user);

                        return $this->goHome();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();

                    return $this->render('index', [
                        'model' => $model,
                        'modelsCourses' => (empty($modelsCourses)) ? [new Courses] : $modelsCourses,
                        'modelsExperiences' => (empty($modelsExperiences)) ? [new Experiences] : $modelsExperiences,
                        'modelsEducationalAttainment' => (empty($modelsEducationalAttainment)) ? [new EducationalAttainment] : $modelsEducationalAttainment,
                    ]);
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

 

  
}
