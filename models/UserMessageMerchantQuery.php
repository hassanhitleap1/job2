<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserMessage]].
 *
 * @see UserMessage
 */
class UserMessageMerchantQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserMessage[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserMessage|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
