<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[PostApply]].
 *
 * @see PostApply
 */
class PostApplyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PostApply[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PostApply|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
