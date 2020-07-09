<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%vedio_user}}".
 *
 * @property int $id
 * @property string|null $video_id
 * @property string $title
 * @property string|null $desc
 * @property int $user_id
 * @property int $from
 * @property string $path
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class VedioUser extends \yii\db\ActiveRecord
{
    public $file;
    const SCENARIO_DEFAULT ="SCENARIO_DEFAULT";
    const SCENARIO_UPLOAD_USER ="SCENARIO_UPLOAD_USER";
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%vedio_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'user_id', 'from', 'path', 'status'], 'required' , 'on' =>Self::SCENARIO_DEFAULT],
            [['user_id', 'from', 'status'], 'integer'],
            [['video_id', 'title'], 'string', 'max' => 250],
            [['desc'], 'string', 'max' => 500],
            [['path'], 'string', 'max' => 100],
            ['file', 'file', 'extensions' => 'webm,mkv,flv,vob,ogv,ogg,mov,wmv,rm,amv,avi,mp4,m4p', 'maxSize' => 512000, 'tooBig' => 'Limit is 500KB'],
           // [['file'], 'vedio', 'skipOnEmpty' => true, 'extensions' => 'webm,mkv,flv,vob,ogv,ogg,mov,wmv,rm,amv,avi,mp4,m4p '],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'video_id' => Yii::t('app', 'Video_ID'),
            'title' => Yii::t('app', 'Title'),
            'desc' => Yii::t('app', 'Desc'),
            'user_id' => Yii::t('app', 'User_ID'),
            'from' => Yii::t('app', 'From'),
            'path' => Yii::t('app', 'Path'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return VedioUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VedioUserQuery(get_called_class());
    }
}
