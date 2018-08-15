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
            'id'           => $this->primaryKey()->unsigned(),
            'user_id'      => $this->integer()->notNull(),
            'last_name'    => $this->string(),
            'first_name'   => $this->string(),
            'patronymic'   => $this->string(),
            'fio'          => $this->string(),
            'image'        => $this->string(),
            'phone'        => $this->string(),
            'email'        => $this->string(),
            'city'         => $this->string(),
            'address'      => $this->string(),
            'type'         => $this->smallInteger(1),
            'organization' => $this->string(),
            'position'     => $this->string()
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

        $this->db->createCommand("INSERT INTO profile (user_id, email, fio) VALUES (1,'suhov.a.s@yandex.ru', 'Админ')")->execute();

        $this->insert('module', ['name' => 'users', 'title' => 'Пользователи и роли']);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='users'")->execute();
        $usersModules = [
            ['user', 'Пользователи', $id],
            ['role', 'Роли', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $usersModules);
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
