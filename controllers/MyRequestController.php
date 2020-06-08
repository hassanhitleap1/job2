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


            $valid = $model->validate() && Model::validateMultiple($modelsEducationalAttainment);
          
            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $model->save(false)) {


                        //________________________________Courses ________________________________
                        if (!empty($deleted_coursesIDs)) {
                            Courses::deleteAll(['id' => $deleted_coursesIDs]);
                        }
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

                        if (!empty($deleted_experiencesIDs)) {
                            Experiences::deleteAll(['id' => $deleted_experiencesIDs]);
                        }


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
                                    ' من ' . $from .' '.
                                    ' الى ' .  $to  . "  " .
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

                        //________________________________ EducationalAttainment ________________________________

                        if (!empty($deleted_educationalAttainmentIDs)) {
                            EducationalAttainment::deleteAll(['id' => $deleted_educationalAttainmentIDs]);
                        }

                    
                        foreach ($_POST['EducationalAttainment'] as $modelsEducationalAttainm) {
                            $model_educational_attainment = new EducationalAttainment();
                            $model_educational_attainment->degree = $modelsEducationalAttainm['degree'];
                            $model_educational_attainment->specialization = $modelsEducationalAttainm['specialization'];
                            $model_educational_attainment->university = $modelsEducationalAttainm['university'];
                            $model_educational_attainment->year_get = $modelsEducationalAttainm['year_get'];


                            $certificate .=
                            $modelsEducationalAttainm['degree'] . "  " .
                            $modelsEducationalAttainm['specialization'] . "  " .
                                $modelsEducationalAttainm['university'] . "  " .
                                $modelsEducationalAttainm['year_get'] .
                                "<br />";
                            $model_educational_attainment->user_id = $model->id;
                            if (!($flag = $model_educational_attainment->save(false))) {
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

}