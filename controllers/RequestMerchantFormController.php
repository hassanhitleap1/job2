<?php

namespace app\controllers;

use Yii;
use app\models\RequestMerchant;
use app\models\RequestMerchantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * RequestMerchantController implements the CRUD actions for RequestMerchant model.
 */
class RequestMerchantController extends Controller
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
     * Lists all RequestMerchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        $model = new RequestMerchantForm();

        if ($model->load(Yii::$app->request->post()) ) {
            if ($model->validate()) {
                 $data['name']=$model->name;
                 $data['name_company']=$model->name_company;
                  $data['phone']=$model->phone;
                  $data['avg_agree']=$model->avg_agree;
                  $data['job_title']=$model->job_title;
                  $data['desc_job']=$model->desc_job;
                  $data['governorate']=$model->governorate;
                  $data['area']=$model->area;
                  $data['nationality']=$model->nationality;
                  $data['avg_salary']=$model->avg_salary;
                  $data['number_of_houer']=$model->number_of_houer;
                  Yii::$app->session->setFlash('success', 'send aplication sucessfuly');
                Yii::$app->db
                ->createCommand()
                ->batchInsert('request_merchant', ['name','name_company', 'phone','avg_agree','job_title','desc_job','governorate','area','nationality','avg_salary','number_of_houer'],[$data])
                ->execute();
                return $this->goHome();
            } 

          
        }

        return $this->goHome();
    }


  


}
