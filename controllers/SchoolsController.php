<?php

namespace app\controllers;

use app\models\ConnectUs;
use app\models\ImagesSchool;
use app\models\Pages;
use Carbon\Carbon;
use Yii;
use app\models\Schools;
use app\models\SchoolsSearch;
use app\models\User;
use Twilio\TwiML\Voice\Connect;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class SchoolsController extends BaseController
{

    /**
     * init controller
     */
    public function init()
    {
        if (!Yii::$app->user->isGuest) {
            if (Yii::$app->user->identity->type != User::ADMIN_USER) {
                throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
            }
        }
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Schools models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SchoolsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Schools model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Schools model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSinglePage($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Schools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schools();
        if ($model->load(Yii::$app->request->post()) ) {
            $insert_id  = (new \yii\db\Query())
                ->select('id')
                ->from('schools')
                ->orderBy([
                    'id' => SORT_DESC
                ])->one()['id'];

             
            if($insert_id==null){
                $insert_id=1;
            }else {
                $insert_id ++;
            }
          

            $file = UploadedFile::getInstance($model, 'logo');
            $images_school = UploadedFile::getInstances($model, 'images_school');

            if (!is_null($file)) {
                $folder_path = "schools/$insert_id";
                FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                $logo = "$folder_path/logo" . "." . $file->extension;
                $model->path_logo= $logo;
                $file->saveAs($logo);
                $model->logo = $logo;
            }

            if (!is_null($images_school)) {

                $folder_path = "schools/$insert_id";
                $i = 1;
                FileHelper::createDirectory("$folder_path/images", $mode = 0775, $recursive = true);
                foreach ($images_school as $image_school) {
                    $modelImagesSchool = new  ImagesSchool();
                    $file_path = "$folder_path/images/$i" . "." . $image_school->extension;
                    $modelImagesSchool->school_id = $insert_id;
                    $modelImagesSchool->path = $file_path;
                    $image_school->saveAs($file_path);
                    $modelImagesSchool->save(false);
                    $i++;
                }
            }

            $date=Carbon::now('Asia/Amman');
            $data2[]=[
                'school_key'=>$model['school_key'],
                'phone'=>$model['phone'],
                'email'=>$model['email'],
                'facebook'=>$model['facebook'],
                "youtube"=>$model['youtube'],
                "twitter"=>$model['twitter'],
                "address"=>$model['address'],
                "location"=>$model['location'],
                'created_at'=>$date,
                'updated_at'=>$date
            ];

            
            $data=[];
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"about"])->one();
            $data[]=["about",$page->title,$page->text,$model->school_key,$date,$date];
            // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"our-vision"])->one();
           $data[]=["our-vision",$page->title,$page->text,$model->school_key,$date,$date];
             // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"our-message"])->one();
           $data[]=["our-message",$page->title,$page->text,$model->school_key,$date,$date];
             // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"our-goals"])->one();
            $data[]=["our-goals",$page->title,$page->text,$model->school_key,$date,$date];
                // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"growth-strategies"])->one();
            $data[]=["growth-strategies",$page->title,$page->text,$model->school_key,$date,$date];

             // ***************************************************************   
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"rate-us"])->one();
        
                $data[]=["rate-us",$page->title,$page->text,$model->school_key,$date,$date];   
                // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"our-responsibility"])->one();
                $data[]=["our-responsibility",$page->title,$page->text,$model->school_key,$date,$date];
                // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"privacy-policy"])->one();
                $data[]=["privacy-policy",$page->title,$page->text,$model->school_key,$date,$date];
                // ***************************************************************
            $page=Pages::find()->where(["school_key"=>"jaras"])->andWhere(['key'=>"terms-conditions"])->one();
            $data[]=["terms-conditions",$page->title,$page->text,$model->school_key,$date,$date];
         
           Yii::$app->db->createCommand()->batchInsert('pages', 
                ['key', 'title', 'text', 'school_key', 'created_at', 'updated_at'],
                $data )->execute();
           

            $conect_us= new ConnectUs();
            $conect_us->school_key = $model->school_key;
            $conect_us->phone = $model->phone;
            $conect_us->email = $model->email;
            $conect_us->facebook = $model->facebook;
            $conect_us->youtube = $model->youtube;
            $conect_us->twitter = $model->twitter; 
            $conect_us->address = $model->address;
            $conect_us->location = $model->location;
            $conect_us->created_at = $date;
            $conect_us->updated_at = $date;
            $conect_us->save();


            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
               
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
          

        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Schools model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $insert_id  = $model->id;
            $file = UploadedFile::getInstance($model, 'logo');
            $images_school = UploadedFile::getInstances($model, 'images_school');
            if ($model->validate()) {

                if (!is_null($file)) {
                    $folder_path = "schools/logo/$insert_id";
                    FileHelper::removeDirectory($folder_path);
                    FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
                    $logo = "$folder_path/logo" . "." . $file->extension;
                    $file->saveAs($logo);
                    $model->path_logo = $logo;
                }




                if (!is_null($images_school)) {

                    $folder_path = "schools/$insert_id";
                    ImagesSchool::deleteAll(['school_id' => $insert_id]);
                    $i = 1;
                    FileHelper::removeDirectory("$folder_path/images");
                    FileHelper::createDirectory("$folder_path/images", $mode = 0775, $recursive = true);
                    foreach ($images_school as $image_school) {
                        $modelImagesSchool = new  ImagesSchool();
                        $file_path = "$folder_path/images/$i" . "." . $image_school->extension;
                        $modelImagesSchool->school_id = $insert_id;
                        $modelImagesSchool->path = $file_path;
                        $image_school->saveAs($file_path);
                        $modelImagesSchool->save(false);
                        $i++;
                    }


                }
            }



            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Schools model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $folder_path="schools/$id";
        rmdir($folder_path);
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Schools model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Schools the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Schools::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
