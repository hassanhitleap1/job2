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
 */
class RequastJob extends \yii\db\ActiveRecord
{
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
            [['agree', 'phone', 'nationality', 'governorate', 'expected_salary'], 'integer'],
            [['certificates', 'experience', 'area','note'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['name','phone', 'nationality','agree', 'governorate'], 'required']
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
            'area'=> Yii::t('app', 'Area'),
            'note' => Yii::t('app', 'Note'),
        ];
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
     * {@inheritdoc}
     * @return RequastJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequastJobQuery(get_called_class());
    }
}
