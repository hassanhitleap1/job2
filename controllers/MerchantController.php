<?php

namespace app\controllers;

use Yii;
use app\models\Merchant;
use app\models\MerchantSearch;
use app\models\RequestMerchant;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;


/**
 * MerchantController implements the CRUD actions for Merchant model.
 */
class MerchantController extends BaseController
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

            //$modelsRequestMerchant = new RequestMerchant;
            $modelsRequestMerchant = Model::createMultiple(RequestMerchant::classname(),$modelsRequestMerchant  );
            Model::loadMultiple($modelsRequestMerchant, Yii::$app->request->post());
           // $modelsRequestMerchant->scenario = RequestMerchant::SCENARIO_MERCHANT;
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsRequestMerchant) && $valid;
           
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
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
            $modelsRequestMerchant = Model::createMultiple(Address::classname(), $modelsRequestMerchant);
            Model::loadMultiple($modelsRequestMerchant, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsRequestMerchant, 'id', 'id')));

            // validate all models
            $valid = $modelsRequestMerchant->validate();
            $valid = Model::validateMultiple($modelsRequestMerchant) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelsRequestMerchant->save(false)) {
                        if (!empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsRequestMerchant as $modelAddress) {
                            $modelAddress->user_id = $modelsRequestMerchant->id;
                            if (!($flag = $modelsRequestMerchant->save(false))) {
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

        return $this->render('update', [
            'model' => $model,
            'modelsRequestMerchant' => (empty($modelsRequestMerchant)) ? [new RequestMerchant] : $modelsRequestMerchant
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
