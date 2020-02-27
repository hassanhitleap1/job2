<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%name_of_jobs}}".
 *
 * @property int $id
 * @property string $name_ar
 */
class NameOfJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%name_of_jobs}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_ar'], 'required'],
            [['name_ar'], 'string', 'max' => 100],
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
     * @return NameOfJobsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new NameOfJobsQuery(get_called_class());
    }
}
