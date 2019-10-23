<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CountSendSms]].
 *
 * @see CountSendSms
 */
class CountSendSmsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CountSendSms[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CountSendSms|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
