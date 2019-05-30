<?php

namespace modules\shop\models;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[RefRequest]].
 *
 * @see RefRequest
 */
class RefRequestQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return RefRequest[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RefRequest|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
