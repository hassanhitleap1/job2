<?php

namespace app\models;


use Yii;
use yii\base\Model;

/**
 * Signup form
 */
class SendSmsModel extends Model
{
    public $body;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['body', 'required'],
        ];
    }

        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'body' => Yii::t('app', 'Body'),
        ];
    }

}