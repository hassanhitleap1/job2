<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%request_merchant}}".
 *
 * @property int $id
 * @property string $job_title
 * @property string $desc_job
 * @property int $salary_from
 * @property int $salary_to
 * @property int $agree_from
 * @property int $agree_to
 * @property int $governorate
 * @property string $area
 * @property int $number_of_houer
 * @property int $nationality
 * @property string $note
 * @property int $user_id
 * @property int $gender
 * @property int $category_id
 */
class RequestMerchant extends \yii\db\ActiveRecord
{
    const SCENARIO_MERCHANT= 'merchant';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request_merchant}}';
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

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_MERCHANT] = ['job_title', 'number_of_houer', 'nationality', 'governorate', 'agree_from', 'agree_to', 'salary_from', 'salary_to'];

        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['desc_job', 'note'], 'string'],
            [['salary_from', 'salary_to', 'agree_from', 'agree_to', 'governorate', 'number_of_houer', 'nationality', 'user_id','gender','category_id'], 'integer'],
            [['job_title', 'area'], 'string', 'max' => 255],
            [['job_title','number_of_houer', 'nationality','governorate','agree_from','agree_to','salary_from','salary_to'], 'required'],
            //[['job_title','number_of_houer', 'nationality','governorate','agree_from','agree_to','salary_from','salary_to'], 'required', 'on' => self::SCENARIO_MERCHANT],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_title' => Yii::t('app', 'Job_Title'),
            'desc_job' => Yii::t('app', 'Desc_Job'),
            'salary_from' => Yii::t('app', 'Salary_From'),
            'salary_to' => Yii::t('app', 'Salary_To'),
            'agree_from' => Yii::t('app', 'Agree_From'),
            'agree_to' => Yii::t('app', 'Agree_To'),
            'governorate' => Yii::t('app', 'Governorate'),
            'area' => Yii::t('app', 'Area'),
            'number_of_houer' => Yii::t('app', 'Number_Of_Houer'),
            'nationality' => Yii::t('app', 'Nationality'),
            'note' => Yii::t('app', 'Note'),
            'category_id'=>Yii::t('app', 'Category'),
            'user_id' => Yii::t('app', 'Name_Marchant'),
            'gender' => Yii::t('app', 'Gender'),
            'experience' => Yii::t('app', 'Experience'),
            'count_employees' => Yii::t('app', 'Count_Employees'),
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
     * @return \yii\db\ActiveQuery
     */
    public function getGovernorate0()
    {
        return $this->hasOne(Governorate::className(), ['id' => 'governorate']);
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
    

    
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }
    /**
     * {@inheritdoc}
     * @return RequestMerchantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequestMerchantQuery(get_called_class());
    }
}
