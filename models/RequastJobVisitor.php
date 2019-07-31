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
 * @property string $note
 */
class RequastJobVisitor extends \yii\db\ActiveRecord
{
 
    public $name;
    public $agree;
    public $phone;
    public $nationality;
    public $certificates;
    public $experience;
    public $governorate;
    public $expected_salary;
    public $area;
    public $note;

    public static function tableName()
    {
        return "requast_job";
    }
    
    
    public function rules()
    {
        return [
            [['name','agree', 'phone', 'nationality','area' ,'governorate'], 'required'],
            [['agree', 'phone', 'nationality', 'governorate', 'expected_salary'], 'integer'],
            [['certificates', 'experience','area' ,'note'], 'string'],
            [['name'], 'string', 'max' => 255],
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


}
