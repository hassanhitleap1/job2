<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%manual_payment_user}}".
 *
 * @property int $id
 * @property int $user_id
 * @property double $amount
 *  @property double $is_first_payment
 * @property string $created_at
 * @property string $updated_at
 */
class ManualPaymentUser extends \yii\db\ActiveRecord
{
    const  FIRST_PATMENT=1;
    const OTHER_PAYMENT=0;
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
            [['user_id','is_first_payment'], 'integer'],
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
            'user_id' => Yii::t('app', 'User_ID'),
            'amount' => Yii::t('app', 'Amount'),
            'is_first_payment'=>Yii::t('app', 'Is_First_Payment'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
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
