<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Degrees]].
 *
 * @see Degrees
 */
class DegreesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Degrees[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Degrees|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
