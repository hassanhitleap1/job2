<?php

namespace app\models;


use Yii;
use yii\base\Model;


/**
 * Signup form
 */
class Document extends Model
{
    public $contract;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['contract', 'required'],
            [['contract'], 'image', 'skipOnEmpty' => true, 'extensions' => 'png,jpg,jpeg,bmp'],
            
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contract' => Yii::t('app', 'Contract'),
        ];
    }

}
