<?php


namespace app\models;


class EmailValidator extends \yii\base\Model
{
     public  $email;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
            [['email'], 'unique', 'targetClass' => '\app\models\User', 'message' => 'This email address has already been taken.'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'Email'),
        ];
    }
}