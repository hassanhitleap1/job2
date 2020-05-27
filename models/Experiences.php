<?php

namespace app\models;

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
            [['user_id', 'job_title', 'month_from_exp', 'year_from_exp', 'month_to_exp', 'year_to_exp', 'facility_name', 'created_at', 'updated_at'], 'required'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'job_title' => Yii::t('app', 'Job Title'),
            'month_from_exp' => Yii::t('app', 'Month From Exp'),
            'year_from_exp' => Yii::t('app', 'Year From Exp'),
            'month_to_exp' => Yii::t('app', 'Month To Exp'),
            'year_to_exp' => Yii::t('app', 'Year To Exp'),
            'facility_name' => Yii::t('app', 'Facility Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
