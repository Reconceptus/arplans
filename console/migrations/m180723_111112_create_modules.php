<?php

use yii\db\Migration;

/**
 * Class m180723_111112_create_modules
 */
class m180723_111112_create_modules extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module', [
            'id'        => $this->primaryKey()->unsigned(),
            'name'      => $this->string(),
            'title'     => $this->string(),
            'parent_id' => $this->integer()->unsigned()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('modules');
    }
}
