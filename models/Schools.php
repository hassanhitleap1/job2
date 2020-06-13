<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%schools}}".
 *
 * @property int $id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 */
class Schools extends \yii\db\ActiveRecord
{
    public $logo;
    public $images_school;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%schools}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['logo'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg '],
            // [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 200],
            [['details', 'director_word', 'discounts_form', 'map', 'contact_information'], 'string']
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
            'details'=>Yii::t('app', 'Details'),
            'director_word' => Yii::t('app', 'Director_Word'),
            'discounts_form' => Yii::t('app', 'Discounts_Form'),
            'map' => Yii::t('app', 'Map'),
            'brochure' => Yii::t('app', 'Brochure'),
            'contact_information' => Yii::t('app', 'Contact_Information'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = Carbon::now("Asia/Amman");
                $this->updated_at = Carbon::now("Asia/Amman");
            } else {
                $this->updated_at = Carbon::now("Asia/Amman");
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImagesSchools()
    {
        return $this->hasMany(ImagesSchool::className(), ['school_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return SchoolsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SchoolsQuery(get_called_class());
    }
}
