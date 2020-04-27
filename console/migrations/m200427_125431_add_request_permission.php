<?php

use yii\db\Migration;

/**
 * Class m200427_125431_add_request_permission
 */
class m200427_125431_add_request_permission extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $request = $auth->createPermission('shop_request');
        $request->description = 'Заявки';
        $auth->add($request);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $request);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $modules = [
            ['request', 'Заявки', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $modules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200427_125431_add_request_permission cannot be reverted.\n";

        return false;
    }
    */
}
