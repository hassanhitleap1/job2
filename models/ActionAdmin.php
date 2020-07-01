<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%action_admin}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $admin_id
 * @property string $action
 * @property string $date
 * @property string $created_at
 * @property string $updated_at
 */
class ActionAdmin extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%action_admin}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'admin_id', 'action', 'date', 'created_at', 'updated_at'], 'required'],
            [['user_id', 'admin_id'], 'integer'],
            [['date', 'created_at', 'updated_at'], 'safe'],
            [['action'], 'string', 'max' => 400],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'admin_id' => Yii::t('app', 'Admin ID'),
            'action' => Yii::t('app', 'Action'),
            'date' => Yii::t('app', 'Date'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
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
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin0()
    {
        return $this->hasOne(User::className(), ['id' => 'admin_id']);
    }
    /**
     * {@inheritdoc}
     * @return ActionAdminQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActionAdminQuery(get_called_class());
    }
}
