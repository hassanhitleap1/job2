<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%request_merchant}}".
 *
 * @property int $id
 * @property string $name
 * @property string $name_company
 * @property int $phone
 * @property int $avg_agree
 * @property string $job_title
 * @property string $desc_job
 * @property int $governorate
 * @property string $area
 * @property int $avg_salary
 * @property int $number_of_houer
 * @property int $note
 */
class RequestMerchant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%request_merchant}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['phone', 'avg_agree', 'governorate', 'avg_salary', 'number_of_houer', 'note'], 'integer'],
            [['desc_job'], 'string'],
            [['name', 'name_company', 'job_title', 'area'], 'string', 'max' => 255],
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
            'name_company' => Yii::t('app', 'Name Company'),
            'phone' => Yii::t('app', 'Phone'),
            'avg_agree' => Yii::t('app', 'Avg Agree'),
            'job_title' => Yii::t('app', 'Job Title'),
            'desc_job' => Yii::t('app', 'Desc Job'),
            'governorate' => Yii::t('app', 'Governorate'),
            'area' => Yii::t('app', 'Area'),
            'avg_salary' => Yii::t('app', 'Avg Salary'),
            'number_of_houer' => Yii::t('app', 'Number Of Houer'),
            'note' => Yii::t('app', 'Note'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return RequestMerchantQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequestMerchantQuery(get_called_class());
    }
}
