<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%governorate}}".
 *
 * @property int $id
 * @property string $name_ar
 */
class Governorate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%governorate}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ar'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_ar' => Yii::t('app', 'Name Ar'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return GovernorateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GovernorateQuery(get_called_class());
    }
}
