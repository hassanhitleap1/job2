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

use app\models\User;
use Carbon\Carbon;
use Yii;

use app\models\RequastJobVisitor;
use Exception;


class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $this->layout = "maintheme";
        
        $model = new RequastJobVisitor();
        $model->scenario  = RequastJobVisitor::CREATE;
        $experience='';
        $certificate='';
        $priorities='';
        $modelsCourses= [new Courses];
        $modelsExperiences= [new Experiences];
        $modelsEducationalAttainment= [new EducationalAttainment];


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
            $now= Carbon::now("Asia/Amman")->toDateTimeString();
            $model->username =null;
            $model->expire_at=$now;
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
                Model::validateMultiple($modelsExperiences) &&
                Model::validateMultiple($modelsCourses) ;

            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::FORM_APPLAY_USER;
                
               $newId= RequastJobVisitor::find()->max('id') + 1;
                
                $file = UploadedFile::getInstance($model, 'cv');
                  if (!is_null($file)) {
                        $folder_path = "users_cv/$newId";
                        FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                        $thumbnail_path = "$folder_path/index" . "." . $file->extension;
                        $file->saveAs($thumbnail_path);
                  
                    }
                
                try {
                
                    if ($flag = $model->save(false)) {
                         //________________________________ EducationalAttainment  ________________________________
                        $data = [];
                        foreach ($_POST['EducationalAttainment'] as $modelsEducationalAttainm) {
                            $data[] = [
                                'degree' => $modelsEducationalAttainm['degree'],
                                'specialization' =>$modelsEducationalAttainm['specialization'],
                                'university' =>$modelsEducationalAttainm['university'],
                                'year_get' => $modelsEducationalAttainm['year_get'],
                                'user_id' => $model->id,
                                'created_at' =>$now,
                                'updated_at' => $now,

                            ];
                            $certificate .=
                                $modelsEducationalAttainm['degree'] . "  " .
                                $modelsEducationalAttainm['specialization']. "  ".
                                $modelsEducationalAttainm['university'] ."  ".
                                $modelsEducationalAttainm['year_get'] .
                                "<br />";

                        }

                        $flag = Yii::$app->db
                            ->createCommand()
                            ->batchInsert(
                                'educational_attainment', ['degree','specialization','university','year_get','user_id', 'created_at', 'updated_at'],$data)->execute();

                        if (!$flag) {
                            $transaction->rollBack();
                            exit;
                        }


                        //________________________________ Experiences ________________________________
                        $data=[];
                        foreach ($_POST['Experiences'] as $modelsExperience) {
                            if ($modelsExperience['date_from'] != '' && $modelsExperience['date_to'] != ''
                            ) {
                                $from = Carbon::parse($modelsExperience['date_from'])->format('Y-m-d');
                                $to = Carbon::parse($modelsExperience['date_to'])->format('Y-m-d');
                                $data[] = [
                                        'job_title' => $modelsExperience['job_title'],
                                        'date_from' => $from,
                                        'date_to' => $to,
                                        'facility_name' => $modelsExperience['facility_name'],
                                        'user_id' => $model->id,
                                        'created_at' => $now,
                                        'updated_at' => $now,

                                    ];
                                $experience .=
                                $modelsExperience['job_title'] . "  " .
                                    ' من ' .  $from . ' ' .
                                    ' الى ' . $to . "  " .
                                    ' في ' . $modelsExperience['facility_name'] .
                                    "<br />";
                                // format date 2019-10-26 15:48:41
                            }
                        }

                        if (count($data)){
                            $flag = Yii::$app->db
                                ->createCommand()
                                ->batchInsert('experiences', ['job_title', 'date_from', 'date_to', 'facility_name', 'user_id', 'created_at', 'updated_at'], $data)
                                ->execute();
                            if (!$flag) {
                                $transaction->rollBack();
                                exit;
                            }

                        }
                        
                        


                        //________________________________Courses ________________________________

                        $data=[];

                        foreach ($_POST['Courses'] as $modelCourse) {
                            $data[] = [
                                'name_course' => $modelCourse['name_course'],
                                'destination' =>$modelCourse['destination'],
                                'duration' => $modelCourse['duration'],
                                'user_id' => $model->id,
                                'created_at' => $now,
                                'updated_at' => $now,
                            ];

                            $priorities .=
                                $modelCourse['name_course'] . "  " .
                                $modelCourse['destination'] . "  " .
                                $modelCourse['duration'] .
                                "<br />";
                        }

                        $flag = Yii::$app->db
                            ->createCommand()
                            ->batchInsert(
                                'courses',
                                ['name_course', 'destination', 'duration', 'user_id', 'created_at', 'updated_at'],
                                $data
                            )
                            ->execute();

                        if (!$flag) {
                            $transaction->rollBack();
                            exit;
                        }

                    }

                    
                    
          
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
                    echo "somthink";
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
