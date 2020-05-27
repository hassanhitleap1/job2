<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%courses}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $name_course
 * @property string $destination
 * @property string $duration
 * @property string $created_at
 * @property string $updated_at
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%courses}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'name_course', 'destination', 'duration', 'created_at', 'updated_at'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name_course', 'destination', 'duration'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name_course' => Yii::t('app', 'Name Course'),
            'destination' => Yii::t('app', 'Destination'),
            'duration' => Yii::t('app', 'Duration'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CoursesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CoursesQuery(get_called_class());
    }
}
