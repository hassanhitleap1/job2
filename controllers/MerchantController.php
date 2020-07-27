<?php

namespace app\controllers;

use app\models\CountSendSms;
use Yii;
use app\models\Merchant;
use app\models\MerchantSearch;
use app\models\RequestMerchant;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use app\models\User;
use Exception;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

/**
 * MerchantController implements the CRUD actions for Merchant model.
 */
class MerchantController extends BaseController
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
                    'forgot-password' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Merchant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MerchantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Merchant model.
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
     * Creates a new Merchant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        
        $model = new Merchant();
        $modelsRequestMerchant= [new RequestMerchant];

        if ($model->load(Yii::$app->request->post())) {
            $modelsRequestMerchant = Model::createMultiple(RequestMerchant::classname(),$modelsRequestMerchant  );
            Model::loadMultiple($modelsRequestMerchant, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsRequestMerchant) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::MERCHANT_USER;
                $model->password_hash = \Yii::$app->security->generatePasswordHash('123456789');
                $file = UploadedFile::getInstance($model, 'file');
                if (!is_null($file)) {
                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar = $imagename;
                }
                try {
                    if ($flag = $model->save()) {
                        foreach ($modelsRequestMerchant as $modelRequestMerchant) {
                            $modelRequestMerchant->user_id = $model->id;
                          
                            if (!($flag = $modelRequestMerchant->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $modelCountSendSms = new CountSendSms();
                        $modelCountSendSms->user_id=$model->id;
                        $modelCountSendSms->count=0;
                        $modelCountSendSms->save(false);
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsRequestMerchant' => (empty($modelsRequestMerchant)) ? [new RequestMerchant] : $modelsRequestMerchant
        ]);

    }

    /**
     * Updates an existing Merchant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
     
        $model = $this->findModel($id);
        $modelsRequestMerchant = $model->requasts;

        if ($model->load(Yii::$app->request->post())) {
        
            $oldIDs = ArrayHelper::map($modelsRequestMerchant, 'id', 'id');
            $modelsRequestMerchant = Model::createMultiple(RequestMerchant::classname(), $modelsRequestMerchant);
            Model::loadMultiple($modelsRequestMerchant, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRequestMerchant, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsRequestMerchant) && $valid;
            if ($valid) {
                $file = UploadedFile::getInstance($model, 'file');
                if (!is_null($file)) {
                    $imagename = 'images/avatar/' . md5(uniqid(rand(), true)) . '.' . $file->extension;
                    $file->saveAs($imagename);
                    $model->avatar = $imagename;
                }
                $transaction = \Yii::$app->db->beginTransaction();
                $model->type = User::MERCHANT_USER;
                try {
                    if ($flag = $model->save()) {
                        foreach ($modelsRequestMerchant as $modelRequestMerchant) {
                            $modelRequestMerchant->user_id = $model->id;

                            if (!($flag = $modelRequestMerchant->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsRequestMerchant' => (empty($modelsRequestMerchant)) ? [new RequestMerchant] : $modelsRequestMerchant
        ]);


      
        // if ($model->load(Yii::$app->request->post())) {
        //     $oldIDs = ArrayHelper::map($modelsRequestMerchant, 'id', 'id');
        //     $modelsRequestMerchant = Model::createMultiple(RequestMerchant::classname(), $modelsRequestMerchant);
        //     Model::loadMultiple($modelsRequestMerchant, Yii::$app->request->post());
        //     $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRequestMerchant, 'id', 'id')));
 
        //     // validate all models
        //     $valid = $modelsRequestMerchant->validate();

        //     $valid = Model::validateMultiple($modelsRequestMerchant) && $valid;
        //     $transaction = \Yii::$app->db->beginTransaction();
          
        //     try {
        //         if ($flag = $model->save()) {
        //             foreach ($modelsRequestMerchant as $modelRequestMerchant) {
        //                 $modelRequestMerchant->user_id = $model->id;

        //                 if (!($flag = $modelRequestMerchant->save(false))) {
        //                     $transaction->rollBack();
        //                     break;
        //                 }
        //             }
        //         }

        //         if ($flag) {
        //             $transaction->commit();
        //             return $this->redirect(['view', 'id' => $model->id]);
        //         }
        //     } catch (Exception $e) {
        //         $transaction->rollBack();
        //     }
        // }
       
        return $this->render('update', [
            'model' => $model,
            'modelsRequestMerchant' => $modelsRequestMerchant
        ]);
    }

    /**
     * Deletes an existing Merchant model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }


    public function actionForgotPassword($id)
    {
        $model = $this->findModel($id);
        $model->password_hash = \Yii::$app->security->generatePasswordHash('123456789');
        $model->save(false);
        return $this->redirect(['index']);
    }
    /**
     * Finds the Merchant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Merchant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Merchant::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
