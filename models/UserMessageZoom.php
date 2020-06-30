<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_message_zoom}}".
 *
 * @property int $id
 * @property string $text
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class UserMessageZoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_message_zoom}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text', 'user_id', 'created_at', 'updated_at'], 'required'],
            [['text'], 'string'],
            [['user_id'], 'integer'],
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
            'text' => Yii::t('app', 'Text'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserMessageZoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMessageZoomQuery(get_called_class());
    }
}
