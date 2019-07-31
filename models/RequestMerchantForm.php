<?php
namespace app\models;
use Yii;
use yii\base\Model;

/** 
* @property string $name
* @property string $name_company
* @property int $phone
* @property int $avg_agree
* @property string $job_title
* @property string $desc_job
* @property int $governorate
* @property string $area
* @property int $nationality
* @property int $avg_salary
* @property int $number_of_houer
*/


class RequestMerchantForm extends Model{

    public $name;
    public $name_company;
    public $phone;
    public $avg_agree;
    public $job_title;
    public $desc_job;
    public $governorate;
    public $area;
    public $nationality;
    public $avg_salary;
    public $number_of_houer;


    
    public static function tableName()
    {
        return "request_merchant";
    }
    
        /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['avg_agree', 'phone', 'nationality','area' ,'job_title', 'governorate','avg_salary'], 'required'],
            [['avg_agree', 'phone', 'nationality', 'governorate', 'avg_salary','number_of_houer'], 'integer'],
            [['name','name_company' , 'job_title ','area' ,'note'], 'string'],
            [['name'], 'string', 'max' => 255],
        ];
    }


        /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Name'),
            'name_company' => Yii::t('app', 'Name_Company'),
            'phone' => Yii::t('app', 'Phone'),
            'avg_agree' => Yii::t('app', 'Avg_Agree'),
            'job_title' => Yii::t('app', 'Job_Title'),
            'desc_job' => Yii::t('app', 'Desc_Job'),
            'governorate' => Yii::t('app', 'Governorate'),
            'nationality'=> Yii::t('app', 'Nationality'),
            'area' => Yii::t('app', 'Area'),
            'avg_salary' => Yii::t('app', 'Avg_Salary'),
            'number_of_houer' => Yii::t('app', 'Number_Of_Houer'),
        ];
    }

}