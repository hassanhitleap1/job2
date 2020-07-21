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
            // [['user_id', 'job_title','date_from','date_to' ,'facility_name'], 'required', 'on' => self::SCENARIO_NORMAL],
            // [['user_id'], 'integer'],
          //  [['date_from','date_to'], 'date', 'format' => 'yyyy-mm-dd'],
            // [['created_at', 'updated_at'], 'safe'],
            // [['job_title', 'facility_name'], 'string', 'max' => 255],

            ['date_to', 'compareDates'],
            [['job_title'],'validate_job_title', 'skipOnEmpty' => false, 'skipOnError' => false],
            [['date_from'],'validate_date_from','skipOnEmpty' => false, 'skipOnError' => false],
            [['date_to'], 'validate_date_to','skipOnEmpty' => false, 'skipOnError' => false],
            [['facility_name'],'validate_facility_name','skipOnEmpty' => false, 'skipOnError' => false],
        ];
    }

//    public function beforeValidate(){
//        $this->date_from=$this->changeFormatDate($this->date_from);
//        $this->date_to=$this->changeFormatDate($this->date_to);
//    }
//
//    private function changeFormatDate($current_date)
//    {
//        $standard = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
//        $eastern_arabic_symbols = array("٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩");
//        return  str_replace($eastern_arabic_symbols, $standard, $current_date);
//    }

    public function compareDates()
    {
        $date_to = strtotime($this->date_to);
        $date_from = strtotime($this->date_from);
        if (!$this->hasErrors() && $date_from > $date_to) {
            $this->addError('date_to', Yii::t('app','Date_To_Not_Valid'));
        }
    }


    public function validate_date_from($attribute, $params){

        if($this->date_from =='' && ($this->job_title !='' || $this->facility_name != ''  ||  $this->date_to!='' )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }


    public function validate_date_to($attribute, $params){
        if($this->date_to =='' && ($this->job_title !='' || $this->facility_name != ''  ||  $this->date_from!='' )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    public function validate_job_title($attribute, $params){
        if($this->job_title =='' && ($this->date_from !='' || $this->facility_name != ''  ||  $this->date_to!='' )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
    }
    public function validate_facility_name($attribute, $params){
        if($this->facility_name =='' && ($this->job_title !='' || $this->date_from != ''  ||  $this->date_to!='' )){
            $this->addError($attribute, Yii::t('app', 'Required'));
        }
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
