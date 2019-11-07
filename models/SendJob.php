<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%send_job}}".
 *
 * @property int $id
 * @property string $body
 */
class SendJob extends \yii\db\ActiveRecord
{
    public $category;
    public $all;
    public $user_id;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%send_job}}';
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'body' => Yii::t('app', 'Body'),
            'category' => Yii::t('app', 'Categories'),
            'all'=> Yii::t('app','All'),
            'user_id'=> Yii::t('app','User'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SendJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SendJobQuery(get_called_class());
    }
}
