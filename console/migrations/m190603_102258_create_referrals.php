<?php

use yii\db\Migration;

/**
 * Class m190603_102258_create_referals
 */
class m190603_102258_create_referrals extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;
        $ref = $auth->createPermission('shop_referral');
        $ref->description = 'Просмотр рефералов';
        $auth->add($ref);
        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $ref);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop' AND parent_id IS NULL ")->queryScalar();
        $shopModules = [
            ['referral', 'Рефералы', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $shopModules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('shop_referral'));
    }
}
