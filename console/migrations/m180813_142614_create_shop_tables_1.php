<?php

use common\models\Translit;
use yii\db\Migration;

/**
 * Class m180813_142614_create_shop_tables_1
 */
class m180813_142614_create_shop_tables_1 extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_category', [
            'id'          => $this->primaryKey()->unsigned(),
            'slug'        => $this->string()->notNull(),
            'name'        => $this->string()->notNull(),
            'description' => $this->text(),
            'image'       => $this->string(),
            'sort'        => $this->integer()->defaultValue(200),
            'is_active'   => $this->smallInteger(1)->defaultValue(1)
        ]);

        $this->createIndex('U_category_slug', 'shop_category', 'slug', true);
        $this->createIndex('U_category_name', 'shop_category', 'name', true);

        $this->createTable('shop_catalog', [
            'id'        => $this->primaryKey()->unsigned(),
            'slug'      => $this->string(),
            'name'      => $this->string()->notNull(),
            'type'      => $this->smallInteger(1),
            'view_type' => $this->smallInteger(1),
            'cart'      => $this->smallInteger(1),
            'order'     => $this->smallInteger(1),
            'filter'    => $this->smallInteger(1),
            'sort'      => $this->integer()->defaultValue(200)
        ]);
        $this->createIndex('U_catalog_slug', 'shop_catalog', 'slug', true);
        $this->createIndex('U_catalog_name', 'shop_catalog', 'name', true);


        $this->createTable('shop_catalog_category', [
            'id'          => $this->primaryKey()->unsigned(),
            'catalog_id'  => $this->integer()->unsigned(),
            'category_id' => $this->integer()->unsigned()
        ]);
        $this->addForeignKey(
            'FK_catalog_category_catalog',
            'shop_catalog_category',
            'catalog_id',
            'shop_catalog',
            'id',
            'CASCADE',
            'CASCADE'
        );
        $this->addForeignKey(
            'FK_catalog_category_category',
            'shop_catalog_category',
            'category_id',
            'shop_category',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $this->createTable('shop_catalog_item', [
            'id'         => $this->primaryKey()->unsigned(),
            'catalog_id' => $this->integer()->unsigned(),
            'slug'       => $this->string(),
            'name'       => $this->string()->unsigned(),
            'sort'       => $this->integer()
        ]);
        $this->createIndex('U_catalog_item_slug', 'shop_catalog_item', 'slug', true);
        $this->addForeignKey(
            'FK_catalog_item_catalog',
            'shop_catalog_item',
            'catalog_id',
            'shop_catalog',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        $this->createTable('shop_item', [
            'id'            => $this->primaryKey()->unsigned(),
            'category_id'   => $this->integer()->unsigned(),
            'slug'          => $this->string(),
            'name'          => $this->string(),
            'description'   => $this->string(),
            'video'         => $this->string(),
            'price'         => $this->integer(),
            'discount'      => $this->integer(),
            'live_area'     => $this->integer(),
            'common_area'   => $this->integer(),
            'useful_area'   => $this->integer(),
            'image_id'      => $this->integer()->unsigned(),
            'one_floor'     => $this->smallInteger(1),
            'two_floor'     => $this->smallInteger(1),
            'mansard'       => $this->smallInteger(1),
            'pedestal'      => $this->smallInteger(1),
            'cellar'        => $this->smallInteger(1),
            'garage'        => $this->smallInteger(1),
            'double_garage' => $this->smallInteger(1),
            'tent'          => $this->smallInteger(1),
            'terrace'       => $this->smallInteger(1),
            'balcony'       => $this->smallInteger(1),
            'light2'        => $this->smallInteger(1),
            'pool'          => $this->smallInteger(1),
            'sauna'         => $this->smallInteger(1),
            'gas_boiler'    => $this->smallInteger(1),
            'is_new'        => $this->smallInteger(1),
            'is_active'     => $this->smallInteger(1),
            'is_deleted'    => $this->smallInteger(1),
            'sort'          => $this->integer()
        ]);
        $this->createIndex('U_item_slug', 'shop_item', 'slug', true);
        $this->createIndex('U_item_name', 'shop_item', 'name', false);
        $this->addForeignKey(
            'FK_item_category',
            'shop_item',
            'category_id',
            'shop_category',
            'id',
            'RESTRICT',
            'RESTRICT'
        );


        $this->createTable('shop_item_image', [
            'id'      => $this->primaryKey()->unsigned(),
            'item_id' => $this->integer()->unsigned(),
            'image'    => $this->string(),
            'thumb'    => $this->string(),
            'sort'    => $this->integer()
        ]);
        $this->addForeignKey(
            'FK_item_image_item',
            'shop_item_image',
            'item_id',
            'shop_item',
            'id',
            'CASCADE',
            'CASCADE'
        );

        $categories = [
            [Translit::encodestring('Деревянные'), 'Деревянные дома'],
            [Translit::encodestring('Каменные'), 'Каменные дома'],
            [Translit::encodestring('Каркасные'), 'Каркасные дома'],
            [Translit::encodestring('Комбинированные'), 'Комбинированные'],
            [Translit::encodestring('Бани'), 'Бани'],
        ];
        $this->batchInsert('shop_category', ['slug', 'name'], $categories);

        $this->insert('module', ['name' => 'shop', 'title' => 'Магазин']);
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
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
        $this->dropForeignKey('FK_item_image_item', 'shop_item_image');
        $this->dropForeignKey('FK_item_category', 'shop_item');
        $this->dropForeignKey('FK_catalog_item_catalog', 'shop_catalog_item');
        $this->dropForeignKey('FK_catalog_category_category', 'shop_catalog_category');
        $this->dropForeignKey('FK_catalog_category_catalog', 'shop_catalog_category');

        $this->dropTable('shop_item_image');
        $this->dropTable('shop_item');
        $this->dropTable('shop_catalog_item');
        $this->dropTable('shop_catalog_category');
        $this->dropTable('shop_catalog');
        $this->dropTable('shop_category');
        $this->dropTable('image');
    }
}
