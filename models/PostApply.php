<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%post_apply}}".
 *
 * @property int $id
 * @property int $post_id
 * @property int $user_id
 * @property string $created_at
 * @property string $updated_at
 */
class PostApply extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%post_apply}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'user_id'], 'required'],
            [['post_id', 'user_id'], 'integer'],
        
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post_ID'),
            'user_id' => Yii::t('app', 'User_ID'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }


    
        /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $date=Carbon::now("Asia/Amman");
        if (parent::beforeSave($insert)) {
            // Place your custom code here
            if ($this->isNewRecord) {
                $this->created_at =  $date;
                $this->updated_at =  $date;
            } else {
                $this->updated_at =  $date;
            }

            return true;
        } else {
            return false;
        }
    }

    /**
     * {@inheritdoc}
     * @return PostApplyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostApplyQuery(get_called_class());
    }
}
