<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%distributor}}".
 *
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 */
class Distributor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%distributor}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'phone'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return DistributorQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DistributorQuery(get_called_class());
    }
}
