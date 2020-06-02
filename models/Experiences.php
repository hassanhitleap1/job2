<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%experiences}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $job_title
 * @property int $month_from_exp
 * @property int $year_from_exp
 * @property int $month_to_exp
 * @property int $year_to_exp
 * @property string $facility_name
 * @property string $created_at
 * @property string $updated_at
 */
class Experiences extends \yii\db\ActiveRecord
{
    const  SCENARIO_ADD='add';
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
            [['user_id', 'job_title', 'month_from_exp', 'year_from_exp', 'month_to_exp', 'year_to_exp', 'facility_name'], 'required', 'on' => self::SCENARIO_ADD],
            [['user_id', 'month_from_exp', 'year_from_exp', 'month_to_exp', 'year_to_exp'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['job_title', 'facility_name'], 'string', 'max' => 255],
        ];
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
            'month_from_exp' => Yii::t('app', 'Month_From_Exp'),
            'year_from_exp' => Yii::t('app', 'Year_From_Exp'),
            'month_to_exp' => Yii::t('app', 'Month_To_Exp'),
            'year_to_exp' => Yii::t('app', 'Year_To_Exp'),
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
