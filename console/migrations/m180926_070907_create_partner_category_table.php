<?php

use yii\db\Migration;

/**
 * Handles the creation of table `partner_category`.
 */
class m180926_070907_create_partner_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('partner_category', [
            'id'          => $this->bigPrimaryKey()->unsigned(),
            'partner_id'  => $this->integer()->unsigned(),
            'category_id' => $this->integer()->unsigned()
        ]);

        $this->addColumn('partner', 'agent_id', $this->integer());

        $this->addForeignKey('FK_partner_category_partner', 'partner_category', 'partner_id', 'partner', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_partner_category_category', 'partner_category', 'category_id', 'shop_category', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('FK_partner_agent', 'partner', 'agent_id', 'user', 'id', 'SET NULL', 'CASCADE');

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_partner_agent', 'partner');
        $this->dropForeignKey('FK_partner_category_partner', 'partner_category');
        $this->dropForeignKey('FK_partner_category_category', 'partner_category');
        $this->dropColumn('partner', 'agent_id');
        $this->dropTable('partner_category');
    }
}
