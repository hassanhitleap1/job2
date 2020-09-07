<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%connect_us}}".
 *
 * @property int $id
 * @property string $school_key
 * @property string $phone
 * @property string $email
 * @property string $facebook
 * @property string $youtube
 * @property string $twitter
 * @property string $address
 * @property string $location
 * @property string $created_at
 * @property string $updated_at
 */
class ConnectUs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%connect_us}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'phone'], 'required'],
            [['id'], 'integer'],
            [['location'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['school_key', 'phone'], 'string', 'max' => 50],
            [['email'], 'string', 'max' => 100],
            [['facebook', 'youtube', 'twitter'], 'string', 'max' => 200],
            [['address'], 'string', 'max' => 500],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'school_key' => Yii::t('app', 'School Key'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'facebook' => Yii::t('app', 'Facebook'),
            'youtube' => Yii::t('app', 'Youtube'),
            'twitter' => Yii::t('app', 'Twitter'),
            'address' => Yii::t('app', 'Address'),
            'location' => Yii::t('app', 'Location'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }


    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $today=Carbon::now("Asia/Amman");
        if(Yii::$app->params['school_key']!="jaras"){
            $this->school_key=Yii::$app->params['school_key'];
        }
    
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
     * @return ConnectUsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ConnectUsQuery(get_called_class());
    }
}
