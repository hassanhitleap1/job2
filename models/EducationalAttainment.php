<?php

namespace app\models;

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
            [['user_id', 'specialization', 'university', 'year_get', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'year_get'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['specialization', 'university'], 'string', 'max' => 250],
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
            'specialization' => Yii::t('app', 'Specialization'),
            'university' => Yii::t('app', 'University'),
            'year_get' => Yii::t('app', 'Year Get'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
}
