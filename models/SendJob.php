<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%send_job}}".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 */
class SendJob extends \yii\db\ActiveRecord
{
    public $category=[];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%send_job}}';
    }

    public function  __construct(){
       $this->category=["ss","ss"]; 
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
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
