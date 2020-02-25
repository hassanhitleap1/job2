<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[RequastJob]].
 *
 * @see RequastJob
 */
class RequastJobGoogleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RequastJob[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RequastJob|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
