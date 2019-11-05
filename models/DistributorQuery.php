<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Distributor]].
 *
 * @see Distributor
 */
class DistributorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Distributor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Distributor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
