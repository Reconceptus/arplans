<?php

use yii\db\Migration;

/**
 * Class m180724_110516_create_roles_and_permissions
 */
class m180724_110516_create_roles_and_permissions extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // создать разрешения
        $adminPanel = $auth->createPermission('adminPanel');
        $adminPanel->description = 'Доступ к админке';
        $auth->add($adminPanel);

        $userPermission = $auth->createPermission('users');
        $userPermission->description = 'Доступ к админке пользователей';
        $auth->add($userPermission);

        $users = $auth->createPermission('users_user');
        $users->description = 'Управление пользователями';
        $auth->add($users);

        $roles = $auth->createPermission('users_role');
        $roles->description = 'Управление ролями';
        $auth->add($roles);

        // создаем роли
        $user = $auth->createRole('user');
        $user->description = 'Пользователь';
        $auth->add($user);

        $manager = $auth->createRole('manager');
        $manager->description = 'Менеджер';
        $auth->add($manager);

        $admin = $auth->createRole('admin');
        $admin->description = 'Администратор';
        $auth->add($admin);

        // делаем наследование
        $auth->addChild($manager, $adminPanel);
        $auth->addChild($admin, $adminPanel);
        $auth->addChild($admin, $userPermission);
        $auth->addChild($admin, $users);
        $auth->addChild($admin, $roles);

        // создаем админского пользователя
        $userAdmin = new \common\models\User();
        $userAdmin->setPassword('111111');
        $userAdmin->username = 'admin';
        $userAdmin->partner_id = 1;
        $userAdmin->email = 'suhov.a.s@yandex.ru';
        $userAdmin->status = \common\models\User::STATUS_ACTIVE;
        $userAdmin->generateAuthKey();
        $userAdmin->save();

        $auth->assign($admin, $userAdmin->getId());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
