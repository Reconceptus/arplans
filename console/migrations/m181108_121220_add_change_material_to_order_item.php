<?php

use yii\db\Migration;

/**
 * Class m181108_121220_add_change_material_to_order_item
 */
class m181108_121220_add_change_material_to_order_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order_item', 'change_material', $this->boolean());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('shop_order_item', 'change_material');
    }
}
