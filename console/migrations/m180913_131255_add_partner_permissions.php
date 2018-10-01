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

        $partnerPanel = $auth->createPermission('partner');
        $partnerPanel->description = 'Доступ к админке партнеров';
        $auth->add($partnerPanel);

        $partner = $auth->createPermission('partner_partner');
        $partner->description = 'Управление партнерами';
        $auth->add($partner);

        $builder = $auth->createPermission('partner_builder');
        $builder->description = 'Управление застройщиками';
        $auth->add($builder);

        $village = $auth->createPermission('partner_village');
        $village->description = 'Управление поселками';
        $auth->add($village);

        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $partnerPanel);
        $auth->addChild($admin, $partner);
        $auth->addChild($admin, $village);

        $this->insert('module', ['name' => 'partner', 'title' => 'Партнеры']);
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='partner'")->queryScalar();
        $partnerModules = [
            ['builder', 'Застройщики', $id],
            ['village', 'Поселки', $id],
            ['partner', 'Партнеры', $id],
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
