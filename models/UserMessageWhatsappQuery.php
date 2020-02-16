<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserMessageWhatsapp]].
 *
 * @see UserMessageWhatsapp
 */
class UserMessageWhatsappQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserMessageWhatsapp[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserMessageWhatsapp|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
