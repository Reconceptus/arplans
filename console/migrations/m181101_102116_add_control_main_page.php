<?php

use yii\db\Migration;

/**
 * Class m181101_102116_add_control_main_page
 */
class m181101_102116_add_control_main_page extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $main = $auth->createPermission('partner_main');
        $main->description = 'Управление информацией на главной странице';
        $auth->add($main);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $main);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='partner'")->queryScalar();
        $partnerModules = [
            ['main', 'Главная страница', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $partnerModules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}
