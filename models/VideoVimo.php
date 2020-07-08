<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%video_vimo}}".
 *
 * @property int $id
 * @property string|null $video_id
 * @property string|null $title
 * @property string|null $desc
 * @property int $user_id
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class VideoVimo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%video_vimo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['video_id', 'title'], 'string', 'max' => 250],
            [['desc'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_id' => Yii::t('app', 'Video ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VideoVimoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideoVimoQuery(get_called_class());
    }
}
