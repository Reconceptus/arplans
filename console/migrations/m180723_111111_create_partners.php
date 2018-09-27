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
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('partner');
    }
}
