<?php


namespace app\controllers;

use Yii;
use app\models\Courses;
use app\models\EducationalAttainment;
use app\models\Experiences;
use app\models\Merchant;
use app\models\Model;
use app\models\RequastJobVisitor;
use Carbon\Carbon;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\NotFoundHttpException;


class MyRequestController extends BaseController
{

    public function actionIndex()
    {

        $model = $this->findModel(Yii::$app->user->identity->id);
        $model->scenario  = RequastJobVisitor::UPDATE;
   
        $modelsCourses= $model->courses;
        $modelsExperiences= $model->experiences;
        $modelsEducationalAttainment= $model->educationalAttainment;
        $experience='';
        $count_experience=0;
        $diff_dayes=0;
        $certificate='';
        $priorities='';

        if ($model->load(Yii::$app->request->post())) {
            //_________________________________________________________________________
            $modelsCourses = Model::createMultiple(Courses::classname(),$modelsCourses);
            Model::loadMultiple($modelsCourses, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsExperiences = Model::createMultiple(Experiences::classname(),$modelsExperiences);
            Model::loadMultiple($modelsExperiences, Yii::$app->request->post());
            //___________________________________________________________________________
            $modelsEducationalAttainment = Model::createMultiple(EducationalAttainment::classname(), $modelsEducationalAttainment);
            Model::loadMultiple($modelsEducationalAttainment, Yii::$app->request->post());
            //___________________________________________________________________________


            $deleted_coursesIDs=Courses::find()->select('id')->where(['user_id'=>Yii::$app->user->identity->id])->asArray()->all();
            $deleted_experiencesIDs = Experiences::find()->select('id')->where(['user_id'=>Yii::$app->user->identity->id])->asArray()->all();
            $deleted_educationalAttainmentIDs = EducationalAttainment::find()->select('id')->where(['user_id'=>Yii::$app->user->identity->id])->asArray()->all();


            $valid = $model->validate() &&
                     Model::validateMultiple($modelsEducationalAttainment) && 
                    Model::validateMultiple($modelsExperiences) &&
                    Model::validateMultiple( $modelsCourses);
          
            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $model->save(false)) {


                        //________________________________Courses ________________________________
                        if (!empty($deleted_coursesIDs)) {
                            Courses::deleteAll(['id' => $deleted_coursesIDs]);
                        }

                        $data=[];

                        foreach ($_POST['Courses'] as $modelCourse) {

                            $data[] = [
                                'name_course' => $modelCourse['name_course'],
                                'destination' =>$modelCourse['destination'],
                                'duration' => $modelCourse['duration'],
                                'user_id' => $model->id
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
                                ['name_course', 'destination', 'duration', 'user_id'],
                                $data
                            )
                            ->execute();

                        if (!$flag) {
                            $transaction->rollBack();
                            exit;
                        }




                        //________________________________ Experiences ________________________________

                        if (!empty($deleted_experiencesIDs)) {
                            Experiences::deleteAll(['id' => $deleted_experiencesIDs]);
                        }

                        $data=[];

                        foreach ($_POST['Experiences'] as $modelsExperience) {
                            if ($modelsExperience['date_from'] != null) {
                                $date_from = $this->changeFormatDate($modelsExperience['date_from']);
                                $date_to = $this->changeFormatDate($modelsExperience['date_to']);
                                $data[]=[
                                    'job_title'=> $modelsExperience['job_title'],
                                    'date_from' => $date_from,
                                    'date_to' => $date_to ,
                                    'facility_name'=>$modelsExperience['facility_name'],
                                    'user_id' => $model->id

                                ];

                                $from = Carbon::parse($date_from);
                                $to = Carbon::parse($date_to);
                                
                                $experience .=
                                    $modelsExperience['job_title'] . "  " .
                                    ' من ' .  Carbon::parse($date_from)->toDateString() . ' ' .
                                    ' الى ' . Carbon::parse($date_to)->toDateString()  . "  " .
                                    ' في ' . $modelsExperience['facility_name'] .
                                    "<br />";
                            
                                $diff_dayes += $from->diffInDays($to);                               
                            }
                        }

                        
                        $flag = Yii::$app->db
                            ->createCommand()
                            ->batchInsert('experiences', ['job_title', 'date_from', 'date_to', 'facility_name', 'user_id'], $data)
                            ->execute();

                        if (!$flag) {
                            $transaction->rollBack();
                            exit;
                        }

                        //________________________________ EducationalAttainment ________________________________

                        if (!empty($deleted_educationalAttainmentIDs)) {
                            EducationalAttainment::deleteAll(['id' => $deleted_educationalAttainmentIDs]);
                        }

                        $data = [];
                        foreach ($_POST['EducationalAttainment'] as $modelsEducationalAttainm) {

                            $data[] = [
                                'degree' => $modelsEducationalAttainm['degree'],
                                'specialization' =>$modelsEducationalAttainm['specialization'],
                                'university' =>$modelsEducationalAttainm['university'],
                                'year_get' => $modelsEducationalAttainm['year_get'],
                                'user_id' => $model->id

                            ];

                            $certificate .=
                            $modelsEducationalAttainm['degree'] . "  " .
                            $modelsEducationalAttainm['specialization'] . "  " .
                                $modelsEducationalAttainm['university'] . "  " .
                                $modelsEducationalAttainm['year_get'] .
                                "<br />";
                            
                        }

                        $flag = Yii::$app->db
                            ->createCommand()
                            ->batchInsert(
                            'educational_attainment', ['degree','specialization','university','year_get','user_id'],$data)->execute();

                        if (!$flag) {
                            $transaction->rollBack();
                            exit;
                        }
                    }



                    
                    if($diff_dayes !=0){
                        $count_experience= round($diff_dayes / 360, 1);
                    }else {
                        
                        $count_experience= $diff_dayes;
                    }

                    $model->year_of_experience= $count_experience;
                    $model->experience= $experience;
                    $model->certificates=$certificate;
                    $model->priorities= $priorities;
                    $model->save(false);


                    if ($flag) {
                        $transaction->commit();
                        Yii::$app->session->set('message', Yii::t('app', 'Successfuly_Message_Update'));

                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                    echo  $e;
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

    /**
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = RequastJobVisitor::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    private function changeFormatDate($current_date)
    {
        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
        return  str_replace($eastern_arabic_symbols, $standard, $current_date);
    }
}

