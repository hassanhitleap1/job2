<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_message}}".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int $user_id
 */
class MessageSchoolOwners extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%message_school_owners}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['text'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
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
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
            'user_id' => Yii::t('app', 'User_ID'),
        ];
    }
}
