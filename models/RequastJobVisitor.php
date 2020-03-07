<?php

namespace app\models;

use Yii;

/**
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
class RequastJobVisitor extends Model
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
    public $gender;
    public $data_of_birth;
    public $documents;
    public $avatar;
    public $cobon;
    public  $cv;
    
    public function rules()
    {
        return [
             [['name','agree', 'phone', 'nationality','area' ,'governorate'], 'required'],
             [['agree', 'phone', 'nationality', 'governorate', 'expected_salary'], 'integer'],
             [['certificates', 'experience','area' ,'note'], 'string'],
             [['name'], 'string', 'max' => 255],
             [['avatar'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg'],
             [['phone'], 'isJordanPhone'],
            [['phone'], 'unique', 'targetClass' => '\app\models\User','message' => Yii::t('app', 'Phone_Already_Exist')],
            [['cv'],  'file',  'skipOnEmpty' => true, 'extensions' => 'pdf,docx,docx'],
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
            "gender"=>Yii::t('app', 'Gender'),
            "data_of_birth" => Yii::t('app', 'Data_Of_Birth'),
            "documents" => Yii::t('app', 'Documents'),
            "avatar"=>Yii::t("app", "Avatar"),
            "cobon"=>Yii::t("app", "Cobon"),
            "CV"=>Yii::t("app", "CV"),

        ];
    }



    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app', 'Check_Phone'));
        }
    }





}
