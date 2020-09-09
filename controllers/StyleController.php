<?php

namespace app\controllers;

use app\models\StyleForm;
use Yii;
use app\models\ActionAdmin;
use app\models\ActionAdminSearch;
use app\models\User;
use Exception;
use yii\helpers\FileHelper;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ActionAdminController implements the CRUD actions for ActionAdmin model.
 */
class StyleController extends BaseController
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
     * Lists all ActionAdmin models.
     * @return mixed
     */
    public function actionIndex()
    {
        $file_path_js = "js/custom.js";
        $file_path_style="css/custom.css";
        $filejs= Yii::getAlias("@webroot/$file_path_js");
        $filecss= Yii::getAlias("@webroot/$file_path_style");
        $fopenjs='';
        $fopencss='';
        try{
            $fopenjs = fopen($filejs, "r");
            fread($fopenjs,filesize($file_path_js));
            fclose($fopenjs);
        }catch(\Exception $e ){
            
        }

        try{
            $fopencss= fopen($filejs, "r");
            fread($fopencss,filesize($file_path_style));
            fclose($fopencss);
        }catch(\Exception $e ){

        }
    
        $model = new StyleForm();
        if ($model->load(Yii::$app->request->post())) {
            echo $model->js;
            exit;
            if ($model->validate()) {
                $a = fopen($filejs, 'w');
                fwrite($a, $model->js);
                fclose($a);
                chmod($filejs, 0755);
                $a = fopen($filecss, 'w');
                fwrite($a, $model->style);
                fclose($a);
                chmod($filecss, 0755);
                
        
            }
        }

        return $this->render('index', [
            'model' => $model,
            'fopenjs'=>$fopenjs,
            'fopencss'=>$fopencss
        ]);
    }


}
