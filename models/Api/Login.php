<?php

namespace app\models\api;

use app\models\User;
use yii\base\Model;

class Login extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = null;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }



    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            if(is_numeric($this->username)){
                $this->_user = User::findByPhone($this->username);
            }else{
                $this->_user = User::findByUsername($this->username);
                if(  $this->_user === null ){
                    $this->_user = User::findByEmail($this->username);
                }
            }
        }

        return $this->_user;
    }

    public function attributeLabels()
    {
        return [
            'Username' => Yii::t('app', 'Username'),
            'password' => Yii::t('app', 'Password'),
            'RememberMe' => Yii::t('app', 'Remember_Me'),

        ];
    }
}