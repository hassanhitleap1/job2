<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RequestMerchant]].
 *
 * @see RequestMerchant
 */
class RequestMerchantQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RequestMerchant[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RequestMerchant|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
