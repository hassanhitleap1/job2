<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rate_users".
 *
 * @property int $id
 * @property int $user_id
 * @property int $merchant_id
 * @property int $rate
 * @property string $date
 */
class RateUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rate_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'merchant_id', 'rate', 'date'], 'required'],
            [['user_id', 'merchant_id', 'rate'], 'integer'],
            [['date'], 'safe'],
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
            'merchant_id' => Yii::t('app', 'Merchant ID'),
            'rate' => Yii::t('app', 'Rate'),
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
