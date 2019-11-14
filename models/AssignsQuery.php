<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Assigns]].
 *
 * @see Assigns
 */
class AssignsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Assigns[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Assigns|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
