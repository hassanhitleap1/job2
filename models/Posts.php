<?php

namespace app\models;

use app\models\Countries\Countries;
use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 * @property int $category_id
 * @property int $accept
 * @property int $area_id
 * @property int $show_number
 * @property string $created_at
 * @property string $updated_at
 */
class Posts extends \yii\db\ActiveRecord
{

    const Accept=1;
    const NonAccept=0;
    const ShowNmber=1;
    const NonShowNmber=0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['body'], 'string'],
            [['category_id', 'accept', 'area_id', 'show_number'], 'integer'],
            [['title'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'category_id' => Yii::t('app', 'Category'),
            'accept' => Yii::t('app', 'Accept'),
            'area_id' => Yii::t('app', 'Area'),
            "user_id"=>Yii::t('app', 'By_User'),
            "region_id"=>Yii::t('app', 'Region'),
            "country_id"=>Yii::t('app', 'Country'),
            'show_number' => Yii::t('app', 'Show_Number'),
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
                $this->user_id=Yii::$app->user->id;
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
     * {@inheritdoc}
     * @return PostsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostsQuery(get_called_class());
    }


     /**
     * @return \yii\db\ActiveQuery
     */
    public function getArea()
    {
        return $this->hasOne(Area::className(), ['id' => 'area_id']);
    }


       /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['id' => 'country_id']);
    }

    
    public function getRegion()
    {
        return $this->hasOne(Countries::className(), ['id' => 'region_id']);
    }


      /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
