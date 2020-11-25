<?php

namespace app\models\Countries;

use Yii;

/**
 * This is the model class for table "{{%countries}}".
 *
 * @property int $id
 * @property string $country_code
 * @property string $name_en
 * @property string $name_ar
 * @property string $nationality_en
 * @property string $nationality_ar
 */
class Countries extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%countries}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country_code'], 'string', 'max' => 2],
            [['name_en', 'name_ar', 'nationality_en', 'nationality_ar'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'country_code' => Yii::t('app', 'Country Code'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_ar' => Yii::t('app', 'Name Ar'),
            'nationality_en' => Yii::t('app', 'Nationality En'),
            'nationality_ar' => Yii::t('app', 'Nationality Ar'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CountriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CountriesQuery(get_called_class());
    }
}
