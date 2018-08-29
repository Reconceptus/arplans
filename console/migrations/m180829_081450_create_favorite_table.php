<?php

use yii\db\Migration;

/**
 * Handles the creation of table `favorite`.
 */
class m180829_081450_create_favorite_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_favorite', [
            'id'      => $this->bigPrimaryKey()->unsigned(),
            'user_id' => $this->integer(),
            'item_id' => $this->integer()->unsigned()
        ]);
        $this->createIndex('U_favorite_user_item', 'shop_favorite', ['user_id', 'item_id'], true);
        $this->addForeignKey('FK_favorite_user', 'shop_favorite', 'user_id', 'user', 'id');
        $this->addForeignKey('FK_favorite_item', 'shop_favorite', 'item_id', 'shop_item', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_favorite_user', 'shop_favorite');
        $this->dropForeignKey('FK_favorite_item', 'shop_favorite');
        $this->dropTable('shop_favorite');
    }
}
