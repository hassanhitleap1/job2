<?php

namespace app\models;

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
            [[ 'phone',  'governorate'], 'integer'],
            [['name_company', 'name', 'note'], 'string'],
            [['name','name_company','phone'], 'required'],   
            [['phone'], 'match', 'pattern' => '/^(079|078|077)[0-9]/'],
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
    public function getRequasts()
    {
        return $this->hasMany(RequestMerchant::className(), ['user_id' => 'id']);
    }
    


}
