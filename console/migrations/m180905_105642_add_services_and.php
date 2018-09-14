<?php

use yii\db\Migration;

/**
 * Class m180905_105642_add_services_and
 */
class m180905_105642_add_services_and extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $values = [
            ['Цена дополнительного альбома', 'album_price', '2000'],
        ];
        Yii::$app->db->createCommand()->batchInsert('config', ['name', 'slug', 'value'], $values)->execute();

        $auth = Yii::$app->authManager;

        $service = $auth->createPermission('shop_service');
        $service->description = 'Услуги';
        $auth->add($service);

        $config = $auth->createPermission('shop_config');
        $config->description = 'Параметры';
        $auth->add($config);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $service);
        $auth->addChild($admin, $config);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $modules = [
            ['service', 'Услуги', $id],
            ['config', 'Параметры', $id],
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
}
