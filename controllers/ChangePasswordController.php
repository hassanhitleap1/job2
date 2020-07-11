<?php

namespace app\controllers;

use app\models\ChangePassword;
use Yii;
use yii\filters\VerbFilter;

/**
 * AreaController implements the CRUD actions for Area model.
 */
class ChangePasswordController extends BaseController
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
     * Lists all Area models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ChangePassword();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Yii::$app->session->set('message', Yii::t('app', 'Succ_Mess_Cont'));
            return $this->render('index', ['model' => $model]);
        }

        return $this->render('index',['model'=>$model]);
    }



}
