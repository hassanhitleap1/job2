<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%user}}".
 * @property int $id
 * @property string $name
 * @property int $phone
 * @property int $nationality
 * @property int $governorate
 * @property string $area
 * @property string $note
 * @property int $type
 * @property string $name_company

 */
class Merchant extends \yii\db\ActiveRecord
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['file'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg '],
            [[ 'phone',  'governorate','area'], 'integer'],
            [['name_company', 'name', 'note', 'location', 'address'], 'string'],
            [['name','name_company','phone'], 'required'],   
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
            'phone' => Yii::t('app', 'Phone'),
            'governorate' => Yii::t('app', 'Governorate'),
            'area' => Yii::t('app', 'Area'),
            'note' => Yii::t('app', 'Note'),
            'name_company' => Yii::t('app', 'Name_Company'),
            'file' => Yii::t('app', 'Avatar'),
            'location' => Yii::t('app', 'Location'),
            'address' => Yii::t('app', 'Address'),

            
        ];
    }

    /**
     * validation patrin
     *
     * @param [type] $attribute
     * @return boolean
     */
    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
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
    public function getRequasts()
    {
        return $this->hasMany(RequestMerchant::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }

}
