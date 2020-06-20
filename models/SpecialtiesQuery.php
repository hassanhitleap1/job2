<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Specialties]].
 *
 * @see Specialties
 */
class SpecialtiesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Specialties[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Specialties|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
