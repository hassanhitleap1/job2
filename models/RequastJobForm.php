<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%requast_job}}".
 *
 * @property int $id
 * @property string $name
 * @property int $agree
 * @property int $phone
 * @property int $nationality
 * @property string $certificates
 * @property string $experience
 * @property int $governorate
 * @property int $expected_salary
 * @property string $area
 * @property string $note
 * @property date $subscribe_date
 * @property int $gender
 * @property string affiliated_with
 * @property string affiliated_to
 * @property string interview_time
 * @property double year_of_experience
 * @property date created_at
 * @property int category_id
 * @property int pay_service
 * @property string  priorities
 * @property int  first_payment
 */
class RequastJobForm extends \yii\db\ActiveRecord
{
    public $file;
    public $assigns_to=[];
    public $assigns_for=[];
    const NOT_INTERVIEWED = 0;
    const WAS_INTERVIEWED=1;
    const IGNORAE = 2;
    const BUSY=3;
    const CONTRACT_WAS_SIGNED=4;
    


    public function getVedio()
    {
        return $this->hasOne(VedioUser::className(), ['user_id' => 'id']);
    }

    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $now=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if($this->isNewRecord){
                 $this->created_at =$now;
                $this->pay_service=1;
                $this->updated_at =$now;
                $modelPaymet= new ManualPaymentUser();
                $modelPaymet->user_id=$this->id;
                $modelPaymet->is_first_payment=ManualPaymentUser::FIRST_PATMENT;
                $modelPaymet->amount=$this->first_payment;
                $modelPaymet->created_at =$now;
                $modelPaymet->updated_at =$now;
                $modelPaymet->save();

            }else{
                $countPayment=ManualPaymentUser::find()->where(['user_id'=>$this->id])->count();
                if($countPayment == 0 ){
                    $modelPaymet= new ManualPaymentUser();
                    $modelPaymet->user_id=$this->id;
                    $modelPaymet->is_first_payment=ManualPaymentUser::FIRST_PATMENT;
                    $modelPaymet->amount=$this->first_payment;
                    $modelPaymet->created_at =$this->created_at;
                    $modelPaymet->updated_at =$this->created_at;;
                    $modelPaymet->save();
                }

                $this->updated_at = Carbon::now("Asia/Amman");
            }

            return true;
        } else {
            return false;
        }
    }

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
            [['file'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png, jpg,jpeg '],
            [['agree', 'phone', 'nationality','work_tolerance', 'teamwork','work_permanently','communication_skills','governorate', 'expected_salary','gender','first_payment'], 'integer'],
            [['certificates', 'experience', 'area','note', 'affiliated_with', 'affiliated_to', 'interview_time','priorities'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['subscribe_date'], 'date', 'format' => 'yyyy-mm-dd'],
            [['name','phone', 'nationality','agree', 'governorate','category_id','first_payment'], 'required'],
            [['phone'], 'isJordanPhone'],
            [['phone'],'unique','message'=>Yii::t('app','Phone_Already_Exist')],           
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'agree' => Yii::t('app', 'Agree'),
            'phone' => Yii::t('app', 'Phone'),
            'nationality' => Yii::t('app', 'Nationality'),
            'certificates' => Yii::t('app', 'Certificates'),
            'experience' => Yii::t('app', 'Experience'),
            'governorate' => Yii::t('app', 'Governorate'),
            'expected_salary' => Yii::t('app', 'Expected_Salary'),
            'category_id'=>Yii::t('app', 'Category'),
            'area'=> Yii::t('app', 'Area'),
            'note' => Yii::t('app', 'Note'),
            'subscribe_date'=>Yii::t('app', 'Subscribe_Date'),
            'avatar'=>Yii::t('app', 'Avatar'),
            'file'=>Yii::t('app', 'Avatar'),
            'gender'=>Yii::t('app', 'Gender'),
            'affiliated_to' => Yii::t('app', 'Affiliated_To'),
            'affiliated_with' => Yii::t('app', 'Affiliated_With'),
            'interview_time' => Yii::t('app', 'Interview_Time'),
            'year_of_experience' => Yii::t('app', 'Year_Of_Experience'),
            'counsendsms'=> Yii::t('app', 'Coun_Send_Sms'),
            'assigns_to'=>Yii::t('app', 'Assigns_To'),
            'assigns_for'=>Yii::t('app', 'Assigns_For'),
            'Created_At' => Yii::t('app', 'Created_At'),
            'priorities' => Yii::t('app', 'Courses'),
            'first_payment'=>Yii::t('app', 'First_Payment'),
            'work_tolerance'=>Yii::t('app', 'Work_Tolerance'),
            'teamwork'=>Yii::t('app', 'Teamwork'),
            'work_permanently'=>Yii::t('app', 'Work_Permanently'),
            'communication_skills'=>Yii::t('app', 'Communication_Skills'),
            'action_user' => Yii::t('app', 'Action_User'),
           

        ];
    }



       /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea0()
    {
        return $this->hasOne(Area::className(), ['id' => 'area']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGovernorate0()
    {
        return $this->hasOne(Governorate::className(), ['id' => 'governorate']);
    }

    public function isJordanPhone($attribute)
    {
        if (!preg_match('/^(079|078|077)[0-9]{7}$/', $this->$attribute)) {
            $this->addError($attribute, Yii::t('app','Check_Phone'));
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNationality0()
    {
        return $this->hasOne(Nationality::className(), ['id' => 'nationality']);
    }
    
        /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory0()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSmssend()
    {
        return $this->hasOne(CountSendSms::className(), ['user_id' => 'id']);
    }

    
    /**
     * {@inheritdoc}
     * @return RequastJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RequastJobFormQuery(get_called_class());
    }
}
