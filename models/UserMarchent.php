<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $name
 * @property string|null $auth_key
 * @property string|null $password_hash
 * @property string|null $password_reset_token
 * @property string|null $email
 * @property int|null $status
 * @property int|null $agree
 * @property string|null $phone
 * @property int|null $nationality
 * @property string|null $certificates
 * @property string|null $experience
 * @property int|null $governorate
 * @property string|null $area
 * @property int|null $expected_salary
 * @property string|null $note
 * @property int|null $type
 * @property string|null $name_company
 * @property string|null $auth_token
 * @property string|null $subscribe_date
 * @property string|null $avatar
 * @property int|null $gender
 * @property string|null $affiliated_to
 * @property string|null $affiliated_with
 * @property string|null $interview_time
 * @property float|null $year_of_experience
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string|null $verification_token
 * @property int|null $category_id
 * @property int $pay_service
 * @property string|null $priorities
 * @property float $first_payment
 * @property int $work_tolerance
 * @property int $teamwork
 * @property int|null $work_permanently
 * @property int $communication_skills
 * @property int|null $verification_email
 * @property int $action_user
 * @property string|null $contract_path
 * @property string|null $location
 * @property string|null $address
 * @property string|null $access_token
 * @property int $expire_at
 * @property int $school_id
 */
class UserMarchent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'agree'], 'integer'],
            ['username', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This username has already been taken.'],
            ['phone', 'unique', 'targetClass' => '\app\models\User', 'message' => 'This phone has already been taken.'],
            [['username', 'name', 'phone', 'name_company'], 'string', 'max' => 255],
            [['username'], 'unique'],
         
           
        ];
    }



        /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $date= Carbon::now("Asia/Amman");
        

        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at =$date;
                $this->updated_at =$date;
                $this->type=User::MERCHANT_USER;
                $this->password_hash=\Yii::$app->security->generatePasswordHash(123456789);
                $this->school_id= Yii::$app->params['school_id'] ;;
                $this->expire_at=$date->toDateTimeString();
            } else {
                $this->updated_at = $date;
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
            'username' => Yii::t('app', 'Username'),
            'name' => Yii::t('app', 'Name'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'agree' => Yii::t('app', 'Agree'),
            'phone' => Yii::t('app', 'Phone'),
            'nationality' => Yii::t('app', 'Nationality'),
            'certificates' => Yii::t('app', 'Certificates'),
            'experience' => Yii::t('app', 'Experience'),
            'governorate' => Yii::t('app', 'Governorate'),
            'area' => Yii::t('app', 'Area'),
            'expected_salary' => Yii::t('app', 'Expected Salary'),
            'note' => Yii::t('app', 'Note'),
            'type' => Yii::t('app', 'Type'),
            'name_company' => Yii::t('app', 'Name Company'),
            'auth_token' => Yii::t('app', 'Auth Token'),
            'subscribe_date' => Yii::t('app', 'Subscribe Date'),
            'avatar' => Yii::t('app', 'Avatar'),
            'gender' => Yii::t('app', 'Gender'),
            'affiliated_to' => Yii::t('app', 'Affiliated To'),
            'affiliated_with' => Yii::t('app', 'Affiliated With'),
            'interview_time' => Yii::t('app', 'Interview Time'),
            'year_of_experience' => Yii::t('app', 'Year Of Experience'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'verification_token' => Yii::t('app', 'Verification Token'),
            'category_id' => Yii::t('app', 'Category ID'),
            'pay_service' => Yii::t('app', 'Pay Service'),
            'priorities' => Yii::t('app', 'Priorities'),
            'first_payment' => Yii::t('app', 'First Payment'),
            'work_tolerance' => Yii::t('app', 'Work Tolerance'),
            'teamwork' => Yii::t('app', 'Teamwork'),
            'work_permanently' => Yii::t('app', 'Work Permanently'),
            'communication_skills' => Yii::t('app', 'Communication Skills'),
            'verification_email' => Yii::t('app', 'Verification Email'),
            'action_user' => Yii::t('app', 'Action User'),
            'contract_path' => Yii::t('app', 'Contract Path'),
            'location' => Yii::t('app', 'Location'),
            'address' => Yii::t('app', 'Address'),
            'access_token' => Yii::t('app', 'Access Token'),
            'expire_at' => Yii::t('app', 'Expire At'),
            'school_id' => Yii::t('app', 'School ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserMarchentQuery(get_called_class());
    }
}
