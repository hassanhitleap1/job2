<?php

namespace app\models;


use Yii;

/**
 * This is the model class for table "{{%requast_job}}".
 *
 * @property int $id
 * @property string $name
 * @property int $agree
 * @property int $phone
 * @property int $nationality
 * @property string $certificates
 * @property string $experience
 * @property int $governorate
 * @property int $expected_salary
 * @property string $area
 * @property string $note
 * @property date $subscribe_date
 * @property int $gender
 * @property string affiliated_with
 * @property string affiliated_to
 * @property string interview_time
 * @property double year_of_experience
 * @property date created_at
 * @property int category_id
 * @property int pay_service
 * @property string  priorities
 * @property int  first_payment
 */
class Users extends \yii\db\ActiveRecord
{
    public $file;
    public $name_of_jobs_id;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }



    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'agree' => Yii::t('app', 'Agree'),
            'phone' => Yii::t('app', 'Phone'),
            'nationality' => Yii::t('app', 'Nationality'),
            'certificates' => Yii::t('app', 'Certificates'),
            'experience' => Yii::t('app', 'Experience'),
            'governorate' => Yii::t('app', 'Governorate'),
            'expected_salary' => Yii::t('app', 'Expected_Salary'),
            'category_id'=>Yii::t('app', 'Category'),
            'area'=> Yii::t('app', 'Area'),
            'note' => Yii::t('app', 'Note'),
            'subscribe_date'=>Yii::t('app', 'Subscribe_Date'),
            'avatar'=>Yii::t('app', 'Avatar'),
            'file'=>Yii::t('app', 'Avatar'),
            'gender'=>Yii::t('app', 'Gender'),
            'affiliated_to' => Yii::t('app', 'Affiliated_To'),
            'affiliated_with' => Yii::t('app', 'Affiliated_With'),
            'interview_time' => Yii::t('app', 'Interview_Time'),
            'year_of_experience' => Yii::t('app', 'Year_Of_Experience'),
            'counsendsms'=> Yii::t('app', 'Coun_Send_Sms'),
            'assigns_to'=>Yii::t('app', 'Assigns_To'),
            'assigns_for'=>Yii::t('app', 'Assigns_For'),
            'Created_At' => Yii::t('app', 'Created_At'),
            'priorities' => Yii::t('app', 'Courses'),
            'first_payment'=>Yii::t('app', 'First_Payment'),
            'work_tolerance'=>Yii::t('app', 'Work_Tolerance'),
            'teamwork'=>Yii::t('app', 'Teamwork'),
            'work_permanently'=>Yii::t('app', 'Work_Permanently'),
            'communication_skills'=>Yii::t('app', 'Communication_Skills'),
            'action_user' => Yii::t('app', 'Action_User'),
            'name_of_jobs_id'=> Yii::t('app', 'Name_Of_Jobs'),

        ];
    }



       /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernorate0()
    {
        return $this->hasOne(Governorate::className(), ['id' => 'governorate']);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    // public function getSpecialtie()
    // {
    //     return $this->hasOne(VedioUser::className(), ['' => 'specialtie_id']);
    // }
    public function getVedio()
    {
        return $this->hasOne(VedioUser::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpecialtie()
    {
        return $this->hasOne(VedioUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNameOfjob()
    {
        return $this->hasOne(VedioUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNationality0()
    {
        return $this->hasOne(Nationality::className(), ['id' => 'nationality']);
    }
    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmssend()
    {
        return $this->hasOne(CountSendSms::className(), ['user_id' => 'id']);
    }

    
    /**
     * {@inheritdoc}
     * @return RequastJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsersQuery(get_called_class());
    }
}
