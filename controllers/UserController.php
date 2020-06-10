<?php
namespace app\controllers;
use app\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

class UserController extends Controller
{


    public function actionVerificationEmail(){
        $codeValidate=@$_GET['verification_email'];

        if(!empty($codeValidate)){
            if(Yii::$app->user->identity->verification_email == $codeValidate){
                $model = $this->findModel(Yii::$app->user->id);
                $model->verification_email= 1;
                $model->save();
                UserHelper::sendEmailValidation();
                return $this->redirect(['/']);
            }
        }
        return $this->render('verification-email');
    }


    /**
     * Finds the Ads model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Ads the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}