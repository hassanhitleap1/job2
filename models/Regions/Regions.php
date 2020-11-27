<?php

namespace app\models\Regions;

use app\models\Countries\Countries;
use app\models\Regions\RegionsQuery;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%regions}}".
 *
 * @property int $id
 * @property string $name_en
 * @property string $name_ar
 * @property int $country_id
 * @property string $created_at
 * @property string $updated_at
 */
class Regions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%regions}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_en', 'name_ar', 'country_id'], 'required'],
            [['country_id'], 'integer'],
            [['name_en', 'name_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'country_id' => Yii::t('app', 'Country ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

   
    /**
     * {@inheritdoc}
     * @return RegionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegionsQuery(get_called_class());
    }


     /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;
            } else {
                $this->updated_at =$today;
            }

            return true;
        } else {
            return false;
        }
    }

}
