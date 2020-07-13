<?php

namespace app\models;

use Carbon\Carbon;
use Yii;

/**
 * This is the model class for table "{{%educational_attainment}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $specialization
 * @property string $university
 * @property int $year_get
 * @property string $created_at
 * @property string $updated_at
 */
class EducationalAttainment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    const SCENARIO_REGISTER = 'register';
    public static function tableName()
    {
        return '{{%educational_attainment}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['degree','specialization', 'university', 'year_get'], 'required',  'on' => self::SCENARIO_REGISTER],
            [['year_get'], 'integer'],
            [['specialization', 'university'], 'string', 'max' => 250],
        ];
    }


    public function is_all_required($attribute,$params)
    {
        $this->addError($attribute, Yii::t('app','Check_Phone'));
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        $statuses = json_encode(Self::find()->select('id')->asArray()->column());
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS
        if ($.inArray(value, $statuses) === -1) {
            messages.push($message);
        }
JS;
    }

    public function clientValidateAttribute2($model, $attribute, $view)
    {
        return <<<JS
        deferred.add(function(def) {
            var img = new Image();
            img.onload = function() {
                if (this.width > 150) {
                    messages.push('Image too wide!!');
                }
                def.resolve();
            }
            var reader = new FileReader();
            reader.onloadend = function() {
                img.src = reader.result;
            }
            reader.readAsDataURL(file);
        });
JS;
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser0()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User_ID'),
            'specialization' => Yii::t('app', 'Specialization'),
            'university' => Yii::t('app', 'University'),
            'year_get' => Yii::t('app', 'Year_Get'),
            'degree' => Yii::t('app', 'Degree'),
            'created_at' => Yii::t('app', 'Created_At'),
            'updated_at' => Yii::t('app', 'Updated_At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return EducationalAttainmentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EducationalAttainmentQuery(get_called_class());
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
}
