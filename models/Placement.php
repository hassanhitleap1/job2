<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%placement}}".
 *
 * @property int $id
 */
class Placement extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%placement}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlacementQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlacementQuery(get_called_class());
    }
}
