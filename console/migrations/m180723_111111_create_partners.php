<?php

use yii\db\Migration;

/**
 * Class m180723_111111_create_partners
 */
class m180723_111111_create_partners extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('partner', [
            'id'   => $this->primaryKey()->unsigned(),
            'name' => $this->string(),
            'url'  => $this->string()
        ]);
        $this->addColumn('user', 'partner_id', $this->integer()->unsigned());
        $this->addForeignKey(
            'FK_user_partner_id',
            'user',
            'partner_id',
            'partner',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_user_partner_id', 'user');
        $this->dropTable('partner');
    }
}
