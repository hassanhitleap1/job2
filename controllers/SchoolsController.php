<?php

namespace app\controllers;

use Yii;
use app\models\Schools;
use app\models\SchoolsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SchoolsController implements the CRUD actions for Schools model.
 */
class SchoolsController extends BaseController
{
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
     * Creates a new Schools model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Schools();
        if ($model->load(Yii::$app->request->post()) ) {
            $insert_id = Yii::app()->db->getLastInsertID();
            $file = UploadedFile::getInstance($model, 'logo');
            $images_school = UploadedFile::getInstance($model, 'images_school');
            if(!is_null($file)){
                $folder_path="schools/logo/$insert_id";
                mkdir($folder_path);
                $logo="$folder_path/logo".".". $file->extension;
                $file->saveAs($logo);
                $model->logo=$logo;
            }
            if(!is_null($images_school)){
                $folder_path="schools/logo/$insert_id";
                foreach ($images_school as $image_school) {
                    $image_school="$folder_path/logo".".". $image_school->extension;
                    $images_school->saveAs($image_school);
                }
            }
            foreach ($this->imageFiles as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            if( $model->validate()){
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
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
            $id=$model->id;
            $file = UploadedFile::getInstance($model, 'logo');
            if(!is_null($file)){
                $folder_path="schools/logo/$id";
                rmdir($folder_path);
                mkdir($folder_path);
                $logo="$folder_path/logo".".". $file->extension;
                $file->saveAs($logo);
                $model->logo=$logo;
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
        $folder_path="schools/logo/$id";
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
