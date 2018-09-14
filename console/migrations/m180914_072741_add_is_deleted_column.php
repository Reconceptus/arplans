<?php

use yii\db\Migration;

/**
 * Class m180914_072741_add_is_deleted_column
 */
class m180914_072741_add_is_deleted_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_service', 'is_active', $this->boolean()->defaultValue(1));
        $this->addColumn('shop_service', 'is_deleted', $this->boolean()->defaultValue(0));

        $this->addColumn('partner', 'is_active', $this->boolean()->defaultValue(1));
        $this->addColumn('partner', 'is_deleted', $this->boolean()->defaultValue(0));

        $this->addColumn('village', 'is_active', $this->boolean()->defaultValue(1));
        $this->addColumn('village', 'is_deleted', $this->boolean()->defaultValue(0));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_service', 'is_active');
        $this->dropColumn('shop_service', 'is_deleted');
        $this->dropColumn('partner', 'is_active');
        $this->dropColumn('partner', 'is_deleted');
        $this->dropColumn('village', 'is_active');
        $this->dropColumn('village', 'is_deleted');
    }
}
