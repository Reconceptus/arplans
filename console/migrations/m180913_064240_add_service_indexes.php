<?php

use yii\db\Migration;

/**
 * Class m180913_064240_add_service_indexes
 */
class m180913_064240_add_service_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createIndex('U_service_slug', 'shop_service','slug',true);
        $this->createIndex('U_service_name', 'shop_service','name',true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
