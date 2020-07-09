<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VedioUser]].
 *
 * @see VedioUser
 */
class VedioUserQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return VedioUser[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return VedioUser|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
