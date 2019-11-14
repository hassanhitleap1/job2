<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%assigns}}".
 *
 * @property int $id
 * @property string $assigns_for
 * @property string $assigns_to
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class Assigns extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%assigns}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['assigns_for', 'assigns_to'], 'string', 'max' => 1200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'assigns_for' => Yii::t('app', 'Assigns For'),
            'assigns_to' => Yii::t('app', 'Assigns To'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return AssignsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AssignsQuery(get_called_class());
    }
}
