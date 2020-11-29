<?php

namespace app\models;


use Yii;
use yii\base\Model;
use app\models\User;
use Carbon\Carbon;
/**
 * Signup form
 */
class SignupForm extends Model
{
    public $phone;
    public $email;
    public $password;
    public $conf_password;
    public $rememberMe = true;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['phone', 'trim'],
            ['phone', 'required'],
            ['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This phone has already been taken.'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['conf_password', 'compare', 'compareAttribute' => 'password', 'message' => Yii::t('app','Pass_Dont_match')],
        ];
    }
    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $date=Carbon::now("Asia/Amman");
        
        $user = new Users();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->status=User::STATUS_ACTIVE;
        $user->type=User::ADMIN_USER;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        $user->created_at=$date;
        $user->updated_at=$date;
        return $user->save(false) && $this->sendEmail($user);
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup_advertiser()
    {
        if (!$this->validate()) {
            return null;
        }
        $date=Carbon::now("Asia/Amman");;
        $user = new Users();
        $user->phone = $this->phone;
        $user->email = $this->email;
        $user->status=User::STATUS_ACTIVE;
        $user->type=User::Advertiser;
        $user->password_hash = Yii::$app->security->generatePasswordHash($this->password);
        $user->auth_key = Yii::$app->security->generateRandomString();
        $user->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
        $user->created_at=$date;
        $user->updated_at=$date;
        return $user->save(false) && $this->sendEmail($user);
    }



      /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login($user)
    {
        return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
    }

}
