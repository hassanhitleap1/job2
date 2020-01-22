<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ManualPaymentUser]].
 *
 * @see ManualPaymentUser
 */
class ManualPaymentUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ManualPaymentUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ManualPaymentUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
