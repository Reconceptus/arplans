<?php

use yii\db\Migration;

/**
 * Handles the creation of table `request`.
 */
class m181015_132050_create_request_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('request', [
            'id'         => $this->primaryKey()->unsigned(),
            'name'       => $this->string(),
            'contact'    => $this->string(),
            'email'      => $this->string(),
            'phone'      => $this->string(),
            'text'       => $this->text(),
            'url'        => $this->string(),
            'file'       => $this->string(),
            'type'       => $this->boolean(),
            'accept'     => $this->boolean(),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('request');
    }
}
