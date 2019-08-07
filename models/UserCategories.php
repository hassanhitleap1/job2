<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user_categories}}".
 *
 * @property int $id
 * @property int $user_id
 * @property int $category_id
 */
class UserCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user_categories}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'category_id'], 'integer'],
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
            'category_id' => Yii::t('app', 'Category ID'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserCategoriesQuery(get_called_class());
    }
}
