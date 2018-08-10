<?php

use yii\db\Migration;

/**
 * Class m180807_121730_create_pages
 */
class m180807_121730_create_pages extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('page', [
            'id'         => $this->primaryKey()->unsigned(),
            'slug'       => $this->string(),
            'image'      => $this->string(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->createTable('pageLang', [
            'id'          => $this->primaryKey()->unsigned(),
            'name'        => $this->string()->notNull(),
            'text'        => $this->text()->notNull(),
            'title'       => $this->string(),
            'keywords'    => $this->string(),
            'description' => $this->string(),
            'language'    => $this->string(6),
            'page_id'     => $this->integer()->unsigned()
        ]);

        $this->addForeignKey('FK_pageLang_page', 'pageLang', 'page_id', 'page', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_pageLang_page', 'pageLang');
        $this->dropTable('pageLang');
        $this->dropTable('page');
    }
}
