<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%courses}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_course
 * @property string $destination
 * @property string $duration
 * @property string $created_at
 * @property string $updated_at
 */
class Courses extends \yii\db\ActiveRecord
{
    const  SCENARIO_ADD='add';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%courses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
//           [['user_id', 'name_course', 'destination', 'duration'], 'required', 'on' => self::SCENARIO_ADD],
//            [['user_id'], 'integer'],
//            [['created_at', 'updated_at'], 'safe'],
//            [['name_course', 'destination', 'duration'], 'string', 'max' => 255],

//            [['name_course'], 'validate_name_course'],
//            [['destination'], 'validate_destination'],
//            [['duration'], 'validate_duration'],
        ];
    }

    public function validate_name_course($attribute, $params){
        if($this->name_course ==null && ($this->destination !==null || $this->duration != null  )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    public function validate_destination($attribute, $params){
        if($this->destination ==null && ($this->name_course !==null || $this->duration != null  )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    public function validate_duration($attribute, $params){
        if($this->duration ==null && ($this->destination !==null || $this->name_course != null   )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User_ID'),
            'name_course' => Yii::t('app', 'Name_Course'),
            'destination' => Yii::t('app', 'Destination'),
            'duration' => Yii::t('app', 'Duration'),
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
     * {@inheritdoc}
     * @return CoursesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursesQuery(get_called_class());
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
