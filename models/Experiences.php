<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%experiences}}".
 *
 * @property int $id
 * @property int $user_id
 * @property date $date_from
 * @property date $date_to
 * @property string $facility_name
 * @property string $created_at
 * @property string $updated_at
 */
class Experiences extends \yii\db\ActiveRecord
{
    const  SCENARIO_UPDATE='update';
    const  SCENARIO_CREATE='create';
    const SCENARIO_NORMAL='normal';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%experiences}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'job_title','date_from','date_to' ,'facility_name'], 'required', 'on' => self::SCENARIO_NORMAL],
            [['user_id'], 'integer'],
            [['date_from','date_to'], 'date', 'format' => 'yyyy-mm-dd'],
            [['created_at', 'updated_at'], 'safe'],
            [['job_title', 'facility_name'], 'string', 'max' => 255],
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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User_ID'),
            'job_title' => Yii::t('app', 'Job_Title'),
            'date_from' => Yii::t('app', 'Date_From'),
            'date_to' => Yii::t('app', 'Date_To'),
            'facility_name' => Yii::t('app', 'Facility_Name'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ExperiencesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ExperiencesQuery(get_called_class());
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
}
