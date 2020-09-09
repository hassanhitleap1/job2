<?php

namespace app\controllers;

use app\models\StyleForm;
use Yii;
use app\models\ActionAdmin;
use app\models\ActionAdminSearch;
use app\models\User;
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
        $model = new StyleForm();
        if ($model->load(Yii::$app->request->post())) {

            if ($model->validate()) {
                $file_path_js = "js/custom.js";
                $file_path_style="css/custom.css";
                $file= Yii::getAlias("@webroot/$file_path_js");
                $a = fopen($file, 'w');
                fwrite($a, $model->js);
                fclose($a);
                chmod($file, 0755);


                $file= Yii::getAlias("@webroot/$file_path_style");
                $a = fopen($file, 'w');
                fwrite($a, $model->style);
                fclose($a);
                chmod($file, 0755);
                
                
//                FileHelper::removeDirectory($folder_path);
//                FileHelper::createDirectory($folder_path, $mode = 0775, $recursive = true);
            }

            return $this->render('index', [
                'model' => $model,
            ]);
        }

        return $this->render('index', [
            'model' => $model,
        ]);
    }


}
