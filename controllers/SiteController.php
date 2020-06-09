<?php

namespace app\controllers;

use app\models\Forgot_Password;
use app\models\Pages;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Merchant;
use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\User;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $namepage="index-local";
        if (Yii::$app->user->isGuest) {
            $this->layout = "maintheme";
            $namepage="index";
        }
        $merchants= Merchant::find()->where(['type'=>User::MERCHANT_USER])->all();
        return $this->render($namepage,[
            'merchants' => $merchants,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = "maintheme";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionForgetPassword()
    {
        $model= new Forgot_Password();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('forgot_password', ['model' => $model]);
        }
        return $this->render('forgot_password',['model'=>$model]);
    }


    public function actionNewPassword()
    {
        $model = new NewPassword;
        $session = Yii::$app->session;
        $token=Yii::$app->request->get('token');
        $tokenRow = ForgotPassword::find()
            ->where('validate_code = :token', [':token' => $token])
            ->one();
        if(empty($tokenRow)){

            $session->set('error_code',1);
            return $this->render('new-password', ['model' => $model]);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($tokenRow->validate_code == $token){
                $user = User::findOne($tokenRow->user_id);
                $user->password_hash = Yii::$app->security->generatePasswordHash($model->password);
                $user->save(false);
                $session->set('create_password', 1);
            }
            return $this->render('new-password', ['model' => $model]);

        }
        return $this->render('new-password', ['model' => $model]);
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'about'])->one();
        return $this->render('about',['page'=>$page]);
    }

    
    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionOurVision()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'our-vision'])->one();
        return $this->render('our-vision',['page'=>$page]);
    }

      /**
     * Displays about page.
     *
     * @return string
     */
    public function actionOurMessage()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'our-message'])->one();
        return $this->render('our-message',['page'=>$page]);
    }
      /**
     * Displays about page.
     *
     * @return string
     */
    public function actionOurGoals()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'our-goals'])->one();
        return $this->render('our-goals',['page'=>$page]);
    }
      /**
     * Displays about page.
     *
     * @return string
     */
    public function actionGrowthStrategies()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'growth-strategies'])->one();
        return $this->render('growth-strategies',['page'=>$page]);
    }

        /**
     * Displays about page.
     *
     * @return string
     */
    public function actionRateUs()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'rate-us'])->one();
        return $this->render('rate-us',['page'=>$page]);
    }


        /**
     * Displays about page.
     *
     * @return string
     */
    public function actionOurResponsibility()
    {
        $this->layout = "maintheme";
        $page=Pages::find()->where(['key'=>'our-responsibility'])->one();
        return $this->render('our-responsibility',['page'=>$page]);
    }


     /**
     * Signs user up.
     *
     * @return mixed
     */
    // public function actionSignup()
    // {
    //     $model = new SignupForm();
    //     if ($model->load(Yii::$app->request->post()) && $model->signup()) {
    //         Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
    //         return $this->goHome();
    //     }
    //     return $this->render('signup', [
    //         'model' => $model,
    //     ]);
    // }


      /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        // $model = new PasswordResetRequestForm();
        // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        //     if ($model->sendEmail()) {
        //         Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
        //         return $this->goHome();
        //     } else {
        //         Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        //     }
        // }
        // return $this->render('requestPasswordResetToken', [
        //     'model' => $model,
        // ]);
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        // try {
        //     $model = new ResetPasswordForm($token);
        // } catch (InvalidArgumentException $e) {
        //     throw new BadRequestHttpException($e->getMessage());
        // }
        // if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
        //     Yii::$app->session->setFlash('success', 'New password saved.');
        //     return $this->goHome();
        // }
        // return $this->render('resetPassword', [
        //     'model' => $model,
        // ]);
    }
    

     /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        // try {
        //     $model = new VerifyEmailForm($token);
        // } catch (InvalidArgumentException $e) {
        //     throw new BadRequestHttpException($e->getMessage());
        // }
        // if ($user = $model->verifyEmail()) {
        //     if (Yii::$app->user->login($user)) {
        //         Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
        //         return $this->goHome();
        //     }
        // }
        // Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        // return $this->goHome();
    }
    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        // $model = new ResendVerificationEmailForm();
        // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        //     if ($model->sendEmail()) {
        //         Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
        //         return $this->goHome();
        //     }
        //     Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        // }
        // return $this->render('resendVerificationEmail', [
        //     'model' => $model
        // ]);
    }
}
