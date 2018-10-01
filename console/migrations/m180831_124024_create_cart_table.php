<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m180831_124024_create_cart_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_cart', [
            'id'      => $this->primaryKey()->unsigned(),
            'guid'    => $this->string(32),
            'user_id' => $this->integer(),
            'item_id' => $this->integer()->unsigned(),
            'count'   => $this->integer()->unsigned()
        ]);

        $this->addForeignKey('FK_cart_user', 'shop_cart', 'user_id', 'user', 'id');
        $this->addForeignKey('FK_cart_item', 'shop_cart', 'item_id', 'shop_item', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_cart_user', 'shop_cart');
        $this->dropForeignKey('FK_cart_item', 'shop_cart');
        $this->dropTable('shop_cart');
    }
}
