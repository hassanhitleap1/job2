<?php

namespace app\controllers;

use Yii;
use app\models\RequastJobVisitor;


class RequatJobController extends \yii\web\Controller
{
    public function actionIndex()
    {
        
        $model = new RequastJobVisitor();

        if ($model->load(Yii::$app->request->post()) ) {
           die('');
        }

        return $this->render('index', [
            'model' => $model,
        ]);
      
    }

}
