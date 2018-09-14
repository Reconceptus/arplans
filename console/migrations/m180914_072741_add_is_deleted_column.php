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
        $this->addColumn('shop_service', 'is_active', $this->boolean());
        $this->addColumn('shop_service', 'is_deleted', $this->boolean());

        $this->addColumn('partner', 'is_active', $this->boolean());
        $this->addColumn('partner', 'is_deleted', $this->boolean());

        $this->addColumn('village', 'is_active', $this->boolean());
        $this->addColumn('village', 'is_deleted', $this->boolean());
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
