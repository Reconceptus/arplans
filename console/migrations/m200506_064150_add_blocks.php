<?php

use yii\db\Migration;

/**
 * Class m200506_064150_add_blocks
 */
class m200506_064150_add_blocks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_block', [
            'id'              => $this->primaryKey()->unsigned(),
            'name'            => $this->string(),
            'description'     => $this->string(),
            'seo_title'       => $this->string(),
            'seo_description' => $this->string(),
            'slug'            => $this->string()->comment('Url'),
            'image'           => $this->string()->comment('Картинка'),
            'status'          => $this->smallInteger(1)->notNull()->defaultValue(1)->comment('Статус'),
            'sort'            => $this->integer()->defaultValue(200)->comment('Сортировка'),
            'created_at'      => $this->dateTime(),
            'updated_at'      => $this->dateTime(),
        ]);
        $this->createIndex('i_block_slug', 'shop_block', 'slug');
        $this->addColumn('selection', 'block_id', $this->integer()->unsigned());

        $shopId = $this->db->createCommand("SELECT id FROM module WHERE name='shop' AND parent_id IS NULL")->queryScalar();
        $shopModules = [
            ['block', 'Группы', $shopId],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $shopModules);
        $auth = Yii::$app->authManager;

        $block = $auth->createPermission('shop_block');
        $block->description = 'Группы';
        $auth->add($block);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('shop_block'));
        $shopId = $this->db->createCommand("SELECT id FROM module WHERE name='shop' AND parent_id IS NULL")->queryScalar();
        $this->delete('module', ['parent_id' => $shopId, 'name' => 'block']);
        $this->dropColumn('selection', 'block_id');
        $this->dropTable('shop_block');
    }
}
