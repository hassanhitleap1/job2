<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[UserMessageZoom]].
 *
 * @see UserMessageZoom
 */
class UserMessageZoomQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return UserMessageZoom[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return UserMessageZoom|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
