<?php

use yii\db\Migration;

/**
 * Class m180808_130911_create_profiles
 */
class m180808_130911_create_profiles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('profile', [
            'id'      => $this->primaryKey()->unsigned(),
            'user_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'FK_profile_user',
            'profile',
            'user_id',
            'user',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_profile_user', 'profile');
        $this->dropTable('profile');
    }
}
