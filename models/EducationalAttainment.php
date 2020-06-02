<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%educational_attainment}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $specialization
 * @property string $university
 * @property int $year_get
 * @property string $created_at
 * @property string $updated_at
 */
class EducationalAttainment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_REGISTER = 'register';
    public static function tableName()
    {
        return '{{%educational_attainment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'specialization', 'university', 'year_get'], 'required',  'on' => self::SCENARIO_REGISTER],
            [['year_get'], 'integer'],
            [['specialization', 'university'], 'string', 'max' => 250],
        ];
    }


    public function is_all_required($attribute,$params)
    {
        $this->addError($attribute, Yii::t('app','Check_Phone'));


    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User_ID'),
            'specialization' => Yii::t('app', 'Specialization'),
            'university' => Yii::t('app', 'University'),
            'year_get' => Yii::t('app', 'Year_Get'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return EducationalAttainmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EducationalAttainmentQuery(get_called_class());
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
