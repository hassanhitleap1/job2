<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ConnectUs]].
 *
 * @see ConnectUs
 */
class ConnectUsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ConnectUs[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ConnectUs|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
