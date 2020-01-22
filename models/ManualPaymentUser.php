<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%manual_payment_user}}".
 *
 * @property int $id
 * @property int $user_id
 * @property double $amount
 * @property string $created_at
 * @property string $updated_at
 */
class ManualPaymentUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%manual_payment_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'amount', 'created_at', 'updated_at'], 'required'],
            [['user_id'], 'integer'],
            [['amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
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
            'amount' => Yii::t('app', 'Amount'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return ManualPaymentUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ManualPaymentUserQuery(get_called_class());
    }
}
