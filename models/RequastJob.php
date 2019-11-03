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
 */
class RequastJob extends \yii\db\ActiveRecord
{
    public $file;

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
    public function rules()
    {
        return [
            [['file'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg '],
            [['agree', 'phone', 'nationality', 'governorate', 'expected_salary','gender', 'year_of_experience'], 'integer'],
            [['certificates', 'experience', 'area','note', 'affiliated_with', 'affiliated_to', 'interview_time'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['subscribe_date'], 'date', 'format' => 'yyyy-mm-dd'],
            [['name','phone', 'nationality','agree', 'governorate','category_id'], 'required'],
            [['phone'], 'isJordanPhone'],
            [['phone'],'unique','message'=>Yii::t('app','Phone_Already_Exist')],           
        ];
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

            
            

        ];
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernorate0()
    {
        return $this->hasOne(Governorate::className(), ['id' => 'governorate']);
    }

    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
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
        return $this->hasOne(Categories::className(), ['id' => 'nationality']);
    }
    
    /**
     * {@inheritdoc}
     * @return RequastJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequastJobQuery(get_called_class());
    }
}
