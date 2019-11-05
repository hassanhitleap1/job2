<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%cobon}}".
 *
 * @property int $id
 * @property int $active
 * @property int $used
 * @property string $number_cobon
 * @property int $distributor_id
 * @property int $used_by
 * @property string $created_at
 * @property string $updated_at
 */
class Cobon extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cobon}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['active', 'used', 'distributor_id', 'used_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['number_cobon'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'active' => Yii::t('app', 'Active'),
            'used' => Yii::t('app', 'Used'),
            'number_cobon' => Yii::t('app', 'Number Cobon'),
            'distributor_id' => Yii::t('app', 'Distributor ID'),
            'used_by' => Yii::t('app', 'Used By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CobonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CobonQuery(get_called_class());
    }
}
