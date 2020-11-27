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

        $query =    Posts::find()->where(['accept'=>Posts::Accept]);;

        if(isset($_GET['search']) && $_GET['search'] !=''){
            $search= trim($_GET['search']);
            if($search !=""){
                $query->andFilterWhere(['like', 'title', $search]);
                $query->orFilterWhere(['like', 'body', $search]);
              //  $query->andWhere("(title like '$search' or body like '$search' )"); 
            }
        }

        

        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count()]);
        $models = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy([
                'created_at' => SORT_DESC //specify sort order ASC for ascending DESC for descending      
            ])
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
        $this->layout = "maintheme";
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
