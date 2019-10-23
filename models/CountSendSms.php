<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%count_send_sms}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $count
 */
class CountSendSms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%count_send_sms}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'count'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'count' => Yii::t('app', 'Count'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CountSendSmsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountSendSmsQuery(get_called_class());
    }
}
