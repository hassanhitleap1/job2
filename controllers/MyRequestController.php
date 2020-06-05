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
        $modelsCourses= $model->courses;
        $modelsExperiences= $model->experiences;
        $modelsEducationalAttainment= $model->educationalAttainment;
        $experience='';
        $count_experience=0;
        $diff_dayes=0;
        $certificate='';

        if ($model->load(Yii::$app->request->post())) {


            $coursesIDs = ArrayHelper::map($modelsCourses, 'id', 'id');
            $experiencesIDs = ArrayHelper::map($modelsExperiences, 'id', 'id');
            $educationalAttainmentIDs = ArrayHelper::map($modelsEducationalAttainment, 'id', 'id');



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

            $deleted_coursesIDs = array_diff($coursesIDs, array_filter(ArrayHelper::map($modelsCourses, 'id', 'id')));
            $deleted_experiencesIDs = array_diff($experiencesIDs, array_filter(ArrayHelper::map($modelsExperiences, 'id', 'id')));
            $deleted_educationalAttainmentIDs = array_diff($educationalAttainmentIDs, array_filter(ArrayHelper::map($modelsEducationalAttainment, 'id', 'id')));


            $valid = $model->validate() && Model::validateMultiple($modelsEducationalAttainment);
            if ($valid) {

                $transaction = \Yii::$app->db->beginTransaction();

                try {

                    if ($flag = $model->save(false)) {


                        //________________________________Courses ________________________________
                        foreach ($_POST['Courses'] as $modelCourse) {
                            $model_course = new Courses();
                            $model_course->name_course = $modelCourse['name_course'];
                            $model_course->destination = $modelCourse['destination'];
                            $model_course->duration = $modelCourse['duration'];
                            // if($modelCourse->name_course != null){
                            $certificate .=
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
                            $model_experiences = new Experiences();
                            $model_experiences->job_title = $modelsExperience['job_title'];
                            $model_experiences->month_from_exp = $modelsExperience['month_from_exp'];
                            $model_experiences->year_from_exp = $modelsExperience['year_from_exp'];
                            $model_experiences->month_to_exp = $modelsExperience['month_to_exp'];
                            $model_experiences->year_to_exp = $modelsExperience['year_to_exp'];
                            $model_experiences->facility_name = $modelsExperience['facility_name'];
                            $experience .=
                                $modelsExperience['job_title'] . "  " .
                                ' من ' . $modelsExperience['month_from_exp'] . '-' . $modelsExperience['year_from_exp']  . "  " .
                                ' الى ' . $modelsExperience['month_to_exp'] . '-' . $modelsExperience['year_to_exp'] . "  " .
                                ' في ' . $modelsExperience['facility_name'] .
                                "<br />";
                            // format date 2019-10-26 15:48:41

                            $from = Carbon::parse(strval($modelsExperience['year_to_exp']) . '-' . strval($modelsExperience['month_to_exp']) . '-' . '1');
                            $to = Carbon::parse(strval($modelsExperience['year_from_exp']) . '-' . strval($modelsExperience['month_from_exp']) . '-' . '1');
                            $diff_dayes += $from->diffInDays($to);


                            $model_experiences->user_id = $model->id;
                            if (!($flag = $model_experiences->save(false))) {
                                $transaction->rollBack();

                                break;
                            }
                        }

                        //________________________________ Experiences ________________________________
                        foreach ($modelsEducationalAttainment as $modelsEducationalAttainm) {
                            $experience .=
                                $modelsEducationalAttainm->specialization . "  " .
                                $modelsEducationalAttainm->university . "  " .
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
                        $transaction->commit();
                        return $this->redirect(['index']);
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