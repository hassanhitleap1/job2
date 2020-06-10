<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ImagesSchool]].
 *
 * @see ImagesSchool
 */
class ImagesSchoolQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ImagesSchool[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ImagesSchool|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
