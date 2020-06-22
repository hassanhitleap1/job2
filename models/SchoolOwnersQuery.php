<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SchoolOwners]].
 *
 * @see SchoolOwners
 */
class SchoolOwnersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SchoolOwners[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SchoolOwners|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
