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
            'id'          => $this->primaryKey()->unsigned(),
            'category_id' => $this->integer()->unsigned()->defaultValue(null),
            'slug'        => $this->string(),
            'name'        => $this->string()->notNull(),
            'type'        => $this->smallInteger(1)->defaultValue(1),
            'view_type'   => $this->smallInteger(1)->defaultValue(1),
            'cart'        => $this->smallInteger(1)->defaultValue(1),
            'order'       => $this->smallInteger(1)->defaultValue(1),
            'filter'      => $this->smallInteger(1)->defaultValue(1),
            'sort'        => $this->integer()->defaultValue(200)
        ]);
        $this->createIndex('U_catalog_slug', 'shop_catalog', ['category_id', 'slug'], true);
        $this->createIndex('U_catalog_name', 'shop_catalog', ['category_id', 'name'], true);

        $this->addForeignKey(
            'FK_catalog_category',
            'shop_catalog',
            'category_id',
            'shop_category',
            'id'
        );

        $this->createTable('shop_catalog_item', [
            'id'         => $this->primaryKey()->unsigned(),
            'catalog_id' => $this->integer()->unsigned(),
            'slug'       => $this->string(),
            'name'       => $this->string()->unsigned(),
            'sort'       => $this->integer()
        ]);
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
            'description'   => $this->text(),
            'build_price'   => $this->text(),
            'video'         => $this->string(),
            'price'         => $this->decimal(14,2)->defaultValue(0),
            'discount'      => $this->decimal(14,2)->defaultValue(0),
            'rooms'         => $this->smallInteger(1),
            'bathrooms'     => $this->smallInteger(1),
            'live_area'     => $this->integer()->defaultValue(0),
            'common_area'   => $this->integer()->defaultValue(0),
            'useful_area'   => $this->integer()->defaultValue(0),
            'image_id'      => $this->integer()->unsigned(),
            'one_floor'     => $this->smallInteger(1)->defaultValue(0),
            'two_floor'     => $this->smallInteger(1)->defaultValue(0),
            'mansard'       => $this->smallInteger(1)->defaultValue(0),
            'pedestal'      => $this->smallInteger(1)->defaultValue(0),
            'cellar'        => $this->smallInteger(1)->defaultValue(0),
            'garage'        => $this->smallInteger(1)->defaultValue(0),
            'double_garage' => $this->smallInteger(1)->defaultValue(0),
            'tent'          => $this->smallInteger(1)->defaultValue(0),
            'terrace'       => $this->smallInteger(1)->defaultValue(0),
            'balcony'       => $this->smallInteger(1)->defaultValue(0),
            'light2'        => $this->smallInteger(1)->defaultValue(0),
            'pool'          => $this->smallInteger(1)->defaultValue(0),
            'sauna'         => $this->smallInteger(1)->defaultValue(0),
            'gas_boiler'    => $this->smallInteger(1)->defaultValue(0),
            'is_new'        => $this->smallInteger(1)->defaultValue(0),
            'is_active'     => $this->smallInteger(1)->defaultValue(1),
            'is_deleted'    => $this->smallInteger(1)->defaultValue(0),
            'sort'          => $this->integer()->defaultValue(200)
        ]);
        $this->createIndex('U_item_slug', 'shop_item', 'slug', true);
        $this->createIndex('U_item_name', 'shop_item', 'name', true);
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
            'type'    => $this->smallInteger(),
            'image'   => $this->string(),
            'thumb'   => $this->string(),
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
            ['catalog', 'Фильтры', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $shopModules);
        $catalogs = [
            [1, 1, 'walls', 'Материал стен'],
            [2, 2, 'walls', 'Материал стен'],
            [3, null, 'size', 'Габариты'],
            [4, null, 'base', 'Фундамент'],
            [5, null, 'roof', 'Тип кровли'],
            [6, null, 'slab', 'Перекрытия 1 этажа'],
            [7, null, 'slab2', 'Перекрытия 2 этажа'],
        ];
        $this->batchInsert('shop_catalog', ['id', 'category_id', 'slug', 'name'], $catalogs);
        $catalogItems = [
            [1, 'brus', 'Из бруса', 1],
            [1, 'lumber', 'Из бревен', 2],
            [2, 'block', 'Из блоков', 1],
            [2, 'brick', 'Из кирпича', 2],
            [3, '', '12х12', 1],
            [3, '', '11х11', 2],
            [3, '', '11х12', 3],
            [3, '', '10х10', 4],
            [3, '', '10х11', 5],
            [3, '', '10х12', 6],
            [3, '', '9х9', 7],
            [3, '', '9х10', 8],
            [3, '', '9х11', 9],
            [3, '', '9х12', 10],
            [3, '', '8х8', 11],
            [3, '', '8х9', 12],
            [3, '', '8х10', 13],
            [3, '', '8х11', 14],
            [3, '', '8х12', 15],
            [3, '', '7х7', 16],
            [3, '', '7х8', 17],
            [3, '', '7х9', 18],
            [3, '', '7х10', 19],
            [3, '', '7х11', 20],
            [3, '', '7х12', 21],
            [3, '', '6х6', 22],
            [3, '', '6х7', 23],
            [3, '', '6х8', 24],
            [3, '', '6х9', 25],
            [3, '', '6х10', 26],
            [3, '', '6х11', 27],
            [3, '', '6х12', 28],
            [3, '', '5х5', 29],
            [3, '', '5х6', 30],
            [3, '', '5х7', 31],
            [3, '', '5х8', 32],
            [3, '', '5х9', 33],
            [4, '', 'свайно-ростверковый', 1],
            [4, '', 'монолитная плита', 2],
            [4, '', 'ленточный сборно-железобетонный', 3],
            [4, '', 'ленточный монолитный', 4],
            [4, '', 'винтовые сваи', 5],
            [5, '', 'мягкая кровля', 1],
            [5, '', 'металлочерепица', 2],
            [5, '', 'ондулин', 1],
            [5, '', 'натуральная черепица', 1],
            [6, '', 'ж/б плиты', 1],
            [6, '', 'монолитное', 2],
            [6, '', 'по деревянным балкам', 3],
            [7, '', 'ж/б плиты', 1],
            [7, '', 'монолитное', 2],
            [7, '', 'по деревянным балкам', 3],
        ];
        $this->batchInsert('shop_catalog_item', ['catalog_id', 'slug', 'name', 'sort'], $catalogItems);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_item_image_item', 'shop_item_image');
        $this->dropForeignKey('FK_item_category', 'shop_item');
        $this->dropForeignKey('FK_catalog_item_catalog', 'shop_catalog_item');

        $this->dropTable('shop_item_image');
        $this->dropTable('shop_item');
        $this->dropTable('shop_catalog_item');
        $this->dropTable('shop_catalog');
        $this->dropTable('shop_category');
    }
}
