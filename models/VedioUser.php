<?php

namespace app\models;

use Carbon\Carbon;
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
    const ACTIVE=1;
    const DISACTIVE=1;
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
            [['title', 'user_id', 'from', 'name_of_jobs_id', 'path', 'status'], 'required' , 'on' =>Self::SCENARIO_DEFAULT],
            [['user_id', 'from', 'name_of_jobs_id','status'], 'integer'],
            [['video_id', 'title'], 'string', 'max' => 250],
            [['desc'], 'string', 'max' => 500],
            [['path'], 'string', 'max' => 100],
            [['file', 'name_of_jobs_id'],'required'],
            ['file', 'file', 'extensions' => 'webm,mkv,flv,vob,ogv,ogg,mov,wmv,avchd,mov,wmv,rm,amv,avi,mp4,m4p', 'maxSize' => 1024 * 1024 * 35 , 'tooBig' => 'Limit is 30MB'],
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
            'name_of_jobs_id'=> Yii::t('app', 'Name_Of_Jobs'),
            'file'=>Yii::t('app', 'File'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }


    public function afterFind()
    {
        if($this->status==1) $this->status=true;
        if($this->status==0) $this->status=false;
        return parent::afterFind();
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = Carbon::now("Asia/Amman");
                $this->updated_at = Carbon::now("Asia/Amman");
            } else {
                $this->updated_at = Carbon::now("Asia/Amman");
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialtie()
    {
        return $this->hasOne(User::className(), ['id' => 'specialtie_id']);
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
