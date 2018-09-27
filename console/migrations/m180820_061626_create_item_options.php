<?php

use yii\db\Migration;

/**
 * Class m180820_061626_create_item_options
 */
class m180820_061626_create_item_options extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_item_option', [
            'id'              => $this->primaryKey()->unsigned(),
            'item_id'         => $this->integer()->unsigned(),
            'catalog_id'      => $this->integer()->unsigned(),
            'catalog_item_id' => $this->integer()->unsigned()
        ]);

        $this->addForeignKey(
            'FK_item_option_catalog',
            'shop_item_option',
            'catalog_id',
            'shop_catalog',
            'id'
        );

        $this->addForeignKey(
            'FK_item_option_catalog_item',
            'shop_item_option',
            'catalog_item_id',
            'shop_catalog_item',
            'id'
        );

        $this->addForeignKey(
            'FK_item_option_item',
            'shop_item_option',
            'item_id',
            'shop_item',
            'id'
        );

        $this->createIndex('U_item_option', 'shop_item_option', ['item_id', 'catalog_id', 'catalog_item_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_item_option_catalog', 'shop_item_option');
        $this->dropForeignKey('FK_item_option_catalog_item', 'shop_item_option');
        $this->dropForeignKey('FK_item_option_item', 'shop_item_option');

        $this->dropTable('shop_item_option');
    }
}
