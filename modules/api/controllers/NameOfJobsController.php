<?php

namespace app\modules\api\controllers;

use app\models\NameOfJobs;
use app\modules\traits\ApiResponser;
use Yii;
use yii\helpers\ArrayHelper;

class NameOfJobsController extends \yii\rest\Controller
{
    use ApiResponser;
    
    public function actionIndex()
    {
        $data=ArrayHelper::map(NameOfJobs::find()->all(), 'id', 'name_ar');
        return $this->success_responce($data);
    }


    
  

}