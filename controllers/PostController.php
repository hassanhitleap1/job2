<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use yii\base\Controller;
use yii\data\Pagination;
use yii\web\NotFoundHttpException;


/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostController extends Controller
{

    public function actionIndex()
    {
        $this->layout = "maintheme"; 

        $query =    Posts::find();

        if(isset($_GET['search']) && $_GET['search'] !=''){
            $query->orwhere(['like', 'title', $_GET['search'] . '%', false]);
            $query->orwhere(['like', 'body', $_GET['search'] . '%', false]);
        }

        

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index',['models'=>$models,'pages'=>$pages]);
    }

   
    public function actionCreate()
    {
        $this->layout = "maintheme"; 
        return $this->render('create');
    }


    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $id=$_GET['id'];
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
