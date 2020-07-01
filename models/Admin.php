<?php

namespace app\models;

use Carbon\Carbon;

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
 * @property string $phone
 * @property int $nationality
 * @property string $certificates
 * @property string $experience
 * @property int $governorate
 * @property string $area
 * @property int $expected_salary
 * @property string $note
 * @property int $type
 * @property string $name_company
 * @property string $auth_token
 * @property string $subscribe_date
 * @property string $avatar
 * @property int $gender
 * @property string $affiliated_to
 * @property string $affiliated_with
 * @property string $interview_time
 * @property double $year_of_experience
 * @property string $created_at
 * @property string $updated_at
 * @property string $verification_token
 * @property int $category_id
 * @property int $pay_service
 * @property string $priorities
 * @property double $first_payment
 * @property int $work_tolerance
 * @property int $teamwork
 * @property int $work_permanently
 * @property int $communication_skills
 * @property int $verification_email
 * @property int $action_user
 * @property string $contract_path
 */
class Admin extends \yii\db\ActiveRecord
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
            [['name', 'phone'], 'required'],
            [[ 'phone'], 'isJordanPhone'],
            [['phone'],'unique','message'=>Yii::t('app','Phone_Already_Exist')],
        ];
    }


    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at = $today;
                $this->updated_at = $today;

            } else {
                $this->updated_at =$today;
            }

            return true;
        } else {
            return false;
        }
    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'phone'=> Yii::t('app', 'Phone'),
        ];
    }

    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
    }
    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
}
