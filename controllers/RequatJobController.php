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
        $model->scenario  = RequastJobVisitor::CREATE;
        $experience='';
        $count_experience=0;
        $diff_dayes=0;
        $certificate='';
        $priorities='';
        $modelsCourses= [new Courses];
        $modelsExperiences= [new Experiences(['scenario' => Experiences::SCENARIO_CREATE])];
        $modelsEducationalAttainment= [new EducationalAttainment(['scenario' => EducationalAttainment::SCENARIO_REGISTER])];


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
            $model->username =null;
            $model->password_hash=Yii::$app->security->generatePasswordHash($model->password);
            $model->status=User::STATUS_ACTIVE;
            $model->expected_salary=0;
            $model->note='';
            $model->name_company='';
            $model->verification_email=1;
            $model->subscribe_date=null;
            // validate all models
            $valid = $model->validate() &&
                Model::validateMultiple($modelsEducationalAttainment) &&
                Model::validateMultiple($modelsExperiences) ;
            
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::FORM_APPLAY_USER;
                
                try {
                
                    if ($flag = $model->save(false)) {


                        //________________________________Courses ________________________________
                        foreach ($_POST['Courses'] as $modelCourse) {
                            $model_course = new Courses();
                            $model_course->name_course = $modelCourse['name_course'];
                            $model_course->destination = $modelCourse['destination'];
                            $model_course->duration = $modelCourse['duration'];
                            // if($modelCourse->name_course != null){
                            $priorities .=
                                $modelCourse['name_course'] . "  " .
                                $modelCourse['destination'] . "  " .
                                $modelCourse['duration'] .
                                "<br />";
                            $model_course->user_id = $model->id;
                            if (!($flag = $model_course->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                            // }

                        }

                        
                        //________________________________ Experiences ________________________________
                        
                        foreach ($_POST['Experiences'] as $modelsExperience) {
                            if($modelsExperience['date_from'] != null){
                                $model_experiences = new Experiences();
                                $model_experiences->job_title= $modelsExperience['job_title'];
                                $model_experiences->date_from= $modelsExperience['date_from'];
                                $model_experiences->date_to= $modelsExperience['date_to'];
                                $model_experiences->facility_name = $modelsExperience['facility_name'];
                                $from = Carbon::parse($modelsExperience['date_from']);
                                $to = Carbon::parse($modelsExperience['date_to']);

                                $experience .=
                                    $modelsExperience['job_title'] . "  " .
                                    ' من ' .  Carbon::parse($modelsExperience['date_from'])->toDateString() .' '.
                                    ' الى ' . Carbon::parse($modelsExperience['date_to'])->toDateString()  . "  " .
                                    ' في ' . $modelsExperience['facility_name'] .
                                    "<br />";
                                // format date 2019-10-26 15:48:41


                                $diff_dayes += $from->diffInDays($to);


                                $model_experiences->user_id = $model->id;
                                if (!($flag = $model_experiences->save(false))) {
                                    $transaction->rollBack();

                                    break;
                                }
                            }

                        }
                    
                         //________________________________ Experiences ________________________________
                        foreach ($_POST['EducationalAttainment'] as $modelsEducationalAttainm) {
                            $model_educational_attainment= new EducationalAttainment();
                            $model_educational_attainment->degree= $modelsEducationalAttainm['degree'];
                            $model_educational_attainment->specialization = $modelsEducationalAttainm['specialization'];
                            $model_educational_attainment->university = $modelsEducationalAttainm['university'];
                            $model_educational_attainment->year_get = $modelsEducationalAttainm['year_get'];
                            $certificate .=
                                $modelsEducationalAttainm['degree'] . "  " .
                                $modelsEducationalAttainm['specialization']. "  ".
                                $modelsEducationalAttainm['university'] ."  ".
                                $modelsEducationalAttainm['year_get'] .
                                "<br />";

                            $model_educational_attainment->user_id = $model->id;
                            if (!($flag = $model_educational_attainment->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    
                    //________________________ some calcuclaclate ____________________
                    if($diff_dayes !=0){
                        $count_experience= round($diff_dayes / 360, 1);
                    }else {
                        # code...
                        $count_experience= $diff_dayes;
                    }
                     
                    $model->year_of_experience= $count_experience;
                    $model->experience= $experience;
                    $model->certificates=$certificate;
                    $model->priorities= $priorities;
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
                    echo $e;
                    exit;
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
