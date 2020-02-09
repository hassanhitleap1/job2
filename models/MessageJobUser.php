<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%message_job_user}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $text
 * @property string $created_at
 * @property string $updated_at
 */
class MessageJobUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message_job_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'text', 'created_at', 'updated_at'], 'required'],
            [['user_id'], 'integer'],
            [['text'], 'string'],
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
            'text' => Yii::t('app', 'Text'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return MessageJobUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MessageJobUserQuery(get_called_class());
    }
}
