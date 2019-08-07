<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SendJob]].
 *
 * @see SendJob
 */
class SendJobQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SendJob[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SendJob|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
