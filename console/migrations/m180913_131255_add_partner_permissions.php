<?php

use yii\db\Migration;

/**
 * Class m180913_131255_add_partner_permissions
 */
class m180913_131255_add_partner_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $partnerPanel = $auth->createPermission('partnerPanel');
        $partnerPanel->description = 'Доступ к админке партнеров';
        $auth->add($partnerPanel);

        $partner = $auth->createPermission('partner');
        $partner->description = 'Управление партнерами';
        $auth->add($partner);

        $village = $auth->createPermission('village');
        $village->description = 'Управление поселками';
        $auth->add($village);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $partnerPanel);
        $auth->addChild($admin, $partner);
        $auth->addChild($admin, $village);

        $this->insert('module', ['name' => 'partner', 'title' => 'Партнеры']);
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='partner'")->queryScalar();
        $partnerModules = [
            ['partner', 'Застройщики', $id],
            ['village', 'Поселки', $id],
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
