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
            [['status', 'agree', 'nationality', 'governorate', 'expected_salary', 'type', 'gender', 'category_id', 'pay_service', 'work_tolerance', 'teamwork', 'work_permanently', 'communication_skills', 'verification_email', 'action_user'], 'integer'],
            [['certificates', 'experience', 'note', 'priorities'], 'string'],
            [['subscribe_date', 'created_at', 'updated_at'], 'safe'],
            [['year_of_experience', 'first_payment'], 'number'],
            [['username', 'name', 'password_hash', 'password_reset_token', 'email', 'phone', 'area', 'name_company', 'auth_token', 'avatar', 'verification_token', 'contract_path'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['affiliated_to', 'affiliated_with', 'interview_time'], 'string', 'max' => 1200],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['email'], 'unique'],
        ];
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
        ];
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
