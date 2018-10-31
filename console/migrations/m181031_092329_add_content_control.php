<?php

use yii\db\Migration;

/**
 * Class m181031_092329_add_content_control
 */
class m181031_092329_add_content_control extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $config = $auth->createPermission('shop_content');
        $config->description = 'Контент-блоки';
        $auth->add($config);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $config);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $modules = [
            ['content', 'Контент-блоки', $id],
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
        echo "m181031_092329_add_content_control cannot be reverted.\n";

        return false;
    }
    */
}
