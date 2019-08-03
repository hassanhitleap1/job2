<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%nationality}}".
 *
 * @property int $id
 * @property string $name_ar
 */
class Nationality extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%nationality}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ar'], 'string', 'max' => 255],
            ['name_ar', 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ar' => Yii::t('app', 'Name_Ar'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return NationalityQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NationalityQuery(get_called_class());
    }
}
