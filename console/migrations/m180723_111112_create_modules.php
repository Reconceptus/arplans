<?php

use common\models\Partner;
use yii\db\Migration;

/**
 * Class m180723_111112_create_modules
 */
class m180723_111112_create_modules extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('module', [
            'id'        => $this->primaryKey()->unsigned(),
            'name'      => $this->string(),
            'title'     => $this->string(),
            'parent_id' => $this->integer()->unsigned()
        ]);

        $this->insert('module', ['name' => 'shop', 'title' => 'Магазин']);
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->execute();
        $shopModules = [
            ['category', 'Категории', $id],
            ['item', 'Товары', $id],
            ['order', 'Заказы', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $shopModules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('modules');
    }
}
