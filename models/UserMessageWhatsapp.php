<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_message_whatsapp}}".
 *
 * @property int $id
 * @property string $test
 * @property int $user_id
 * @property int $marchent_id
 * @property string $created_at
 * @property string $updated_at
 */
class UserMessageWhatsapp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_message_whatsapp}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['test', 'user_id', 'marchent_id', 'created_at', 'updated_at'], 'required'],
            [['test'], 'string'],
            [['user_id', 'marchent_id'], 'integer'],
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
            'test' => Yii::t('app', 'Test'),
            'user_id' => Yii::t('app', 'User_ID'),
            'marchent_id' => Yii::t('app', 'Marchent_ID'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

            /**
     * @return \yii\db\ActiveQuery
     */
    public function getMarchent0()
    {
        return $this->hasOne(User::className(), ['id' => 'marchent_id']);
    }

    /**
     * {@inheritdoc}
     * @return UserMessageWhatsappQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMessageWhatsappQuery(get_called_class());
    }
}
