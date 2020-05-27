<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[EducationalAttainment]].
 *
 * @see EducationalAttainment
 */
class EducationalAttainmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return EducationalAttainment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return EducationalAttainment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
