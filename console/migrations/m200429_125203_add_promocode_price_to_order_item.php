<?php

use yii\db\Migration;

/**
 * Class m200429_125203_add_promocode_price_to_order_item
 */
class m200429_125203_add_promocode_price_to_order_item extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order_item', 'price_after_promocode', $this->decimal(14, 2));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       $this->dropColumn('shop_order_item','price_after_promocode');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200429_125203_add_promocode_price_to_order_item cannot be reverted.\n";

        return false;
    }
    */
}
