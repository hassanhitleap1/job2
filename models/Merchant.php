<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $agree
 * @property int $phone
 * @property int $nationality
 * @property string $certificates
 * @property string $experience
 * @property int $governorate
 * @property string $area
 * @property int $expected_salary
 * @property string $note
 * @property int $type
 * @property string $name_company
 * @property int $created_at
 * @property int $updated_at
 * @property string $verification_token
 */
class Merchant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'phone',  'governorate'], 'integer'],
            [['name_company', 'name', 'note'], 'string'],
            [['name_company', 'name'], 'required'],
           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'phone' => Yii::t('app', 'Phone'),
            'governorate' => Yii::t('app', 'Governorate'),
            'area' => Yii::t('app', 'Area'),
            'note' => Yii::t('app', 'Note'),
            'name_company' => Yii::t('app', 'Name_Company'),
        ];
    }


        /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernorate0()
    {
        return $this->hasOne(Governorate::className(), ['id' => 'governorate']);
    }




}
