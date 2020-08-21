<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "favorite_users".
 *
 * @property int $id
 * @property int $user_id
 * @property int $merchant_id
 * @property string $date
 */
class FavoriteUsers extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'favorite_users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'merchant_id', 'date'], 'required'],
            [['user_id', 'merchant_id'], 'integer'],
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
            'date' => Yii::t('app', 'Date'),
        ];
    }
}
