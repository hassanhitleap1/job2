<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Governorate]].
 *
 * @see Governorate
 */
class GovernorateQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Governorate[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Governorate|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
