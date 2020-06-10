<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "images_school".
 *
 * @property int $id
 * @property int $school_id
 * @property string $path
 */
class ImagesSchool extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'images_school';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['school_id', 'path'], 'required'],
            [['school_id'], 'integer'],
            [['path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_id' => Yii::t('app', 'School ID'),
            'path' => Yii::t('app', 'Path'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ImagesSchoolQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ImagesSchoolQuery(get_called_class());
    }
}
