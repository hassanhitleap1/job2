<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[NameOfJobs]].
 *
 * @see NameOfJobs
 */
class NameOfJobsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return NameOfJobs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NameOfJobs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
