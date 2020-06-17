<?php


namespace app\controllers;
use Yii;
use app\models\EmailValidator;
use app\models\User;
use yii\web\Response;

class EmailValidatorController extends  BaseController
{
    /**
     * Creates a new Area model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new EmailValidator();
        $request = \Yii::$app->getRequest();
        if ($request->isPost && $model->load($request->post()) ) {

            \Yii::$app->response->format = Response::FORMAT_JSON;

            if($model->validate()){
                $user=User::findOne(Yii::$app->user->identity->id);
                $user->email=$model->email;
               $user->save(false);
               $data['code']=401;
                return $data;
            }else{
                $data['code']=405;
                $data['content']= $this->renderAjax('index', [
                    'model' => $model,
                ]);
                return $data;
            }

        }

        return $this->renderAjax('index', [
            'model' => $model,
        ]);

    }
}