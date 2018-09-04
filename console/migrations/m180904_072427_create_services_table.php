<?php

use yii\db\Migration;

/**
 * Handles the creation of table `services`.
 */
class m180904_072427_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_service', [
            'id'          => $this->primaryKey()->unsigned(),
            'name'        => $this->string(),
            'slug'        => $this->string(),
            'description' => $this->text(),
            'price'       => $this->decimal(14, 2),
            'in_cart'     => $this->boolean()
        ]);

        $this->createTable('shop_order', [
            'id'         => $this->primaryKey()->unsigned(),
            'user_id'    => $this->integer(),
            'status'     => $this->smallInteger(2),
            'comment'    => $this->string(800),
            'fio'        => $this->string(),
            'phone'      => $this->string(50),
            'email'      => $this->string(50),
            'country'    => $this->string(),
            'city'       => $this->string(),
            'address'    => $this->string(),
            'village'    => $this->string(800),
            'payment_id' => $this->integer()->unsigned(),
            'price'      => $this->decimal(14, 2)->comment('Цена только товаров, без допуслуг'),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('FK_order_user', 'shop_order', 'user_id', 'user', 'id');


        $this->createTable('shop_order_item', [
            'id'       => $this->primaryKey()->unsigned(),
            'order_id' => $this->integer()->unsigned()->notNull(),
            'item_id'  => $this->integer()->unsigned()->notNull(),
            'count'    => $this->integer()->unsigned()->notNull(),
            'price'    => $this->decimal(14, 2),
            'comment'  => $this->string(800)
        ]);

        $this->addForeignKey('FK_order_item_order', 'shop_order_item', 'order_id', 'shop_order', 'id');
        $this->addForeignKey('FK_order_item_item', 'shop_order_item', 'item_id', 'shop_item', 'id');
        $this->createIndex('U_order_item_order_item', 'shop_order_item', ['order_id', 'item_id'], true);


        $this->createTable('shop_order_service', [
            'id'         => $this->integer()->unsigned(),
            'order_id'   => $this->integer()->unsigned()->notNull(),
            'service_id' => $this->integer()->unsigned()->notNull(),
            'price'      => $this->decimal(14, 2)->notNull()
        ]);

        $this->addForeignKey('FK_order_service_order', 'shop_order_service', 'order_id', 'shop_order', 'id');
        $this->addForeignKey('FK_order_service_service', 'shop_order_service', 'service_id', 'shop_service', 'id');
        $this->createIndex('U_order_service_order_service', 'shop_order_service', ['order_id', 'service_id'], true);

        $this->createTable('payment_system', [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'slug' => $this->string(),
        ]);
        $this->addForeignKey('FK_order_payment', 'shop_order', 'payment_id', 'payment_system', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_order_payment', 'shop_order');
        $this->dropForeignKey('FK_order_user', 'shop_order');
        $this->dropForeignKey('FK_order_item_order', 'shop_order_item');
        $this->dropForeignKey('FK_order_item_item', 'shop_order_item');
        $this->dropForeignKey('FK_order_service_order', 'shop_order_service');
        $this->dropForeignKey('FK_order_service_service', 'shop_order_service');
        $this->dropTable('shop_services');
        $this->dropTable('shop_order_service');
        $this->dropTable('shop_order_item');
        $this->dropTable('shop_order');
    }
}
