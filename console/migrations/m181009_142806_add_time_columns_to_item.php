<?php

use yii\db\Migration;

/**
 * Class m181009_142806_add_time_columns_to_item
 */
class m181009_142806_add_time_columns_to_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_item', 'created_at', $this->dateTime());
        $this->addColumn('shop_item', 'updated_at', $this->dateTime());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_item', 'created_at');
        $this->dropColumn('shop_item', 'updated_at');
    }
}
