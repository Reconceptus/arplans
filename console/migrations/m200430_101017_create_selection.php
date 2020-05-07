<?php

use yii\db\Migration;

/**
 * Class m200430_101017_create_selection
 */
class m200430_101017_create_selection extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('selection', [
            'id'            => $this->primaryKey()->unsigned(),
            'name'          => $this->string(),
            'slug'          => $this->string(),
            'description'   => $this->string(10000),
            'min_price'     => $this->decimal(14, 2),
            'max_price'     => $this->decimal(14, 2),
            'min_bedrooms'  => $this->smallInteger(),
            'max_bedrooms'  => $this->smallInteger(),
            'min_bathrooms' => $this->smallInteger(1),
            'max_bathrooms' => $this->smallInteger(1),
            'min_area'      => $this->integer(),
            'max_area'      => $this->integer(),
            'one_floor'     => $this->boolean(),
            'two_floor'     => $this->boolean(),
            'mansard'       => $this->boolean(),
            'pedestal'      => $this->boolean(),
            'cellar'        => $this->boolean(),
            'garage'        => $this->boolean(),
            'double_garage' => $this->boolean(),
            'tent'          => $this->boolean(),
            'terrace'       => $this->boolean(),
            'balcony'       => $this->boolean(),
            'light2'        => $this->boolean(),
            'pool'          => $this->boolean(),
            'sauna'         => $this->boolean(),
            'gas_boiler'    => $this->boolean(),
            'status'        => $this->smallInteger()->defaultValue(1),
            'created_at'    => $this->dateTime(),
            'updated_at'    => $this->dateTime()
        ], $tableOptions);

        $this->createTable('selection_option', [
            'id'             => $this->primaryKey()->unsigned(),
            'selection_id'   => $this->integer()->unsigned()->comment('Selection'),
            'filter_id'      => $this->integer()->unsigned()->comment('Filter'),
            'filter_item_id' => $this->integer()->unsigned()->comment('Filter Item'),
        ], $tableOptions);
        $this->addForeignKey('fk_selection_option_filter', 'selection_option', 'filter_id', 'shop_catalog', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_selection_option_filter_item', 'selection_option', 'filter_item_id', 'shop_catalog_item', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_selection_option_selection', 'selection_option', 'selection_id', 'selection', 'id', 'cascade', 'cascade');

        $this->createTable('selection_item', [
            'id'           => $this->bigPrimaryKey(),
            'selection_id' => $this->integer()->unsigned(),
            'item_id'      => $this->integer()->unsigned()->comment('Item'),
            'status'       => $this->smallInteger(1)->defaultValue(0)
        ], $tableOptions);
        $this->addForeignKey('fk_selection_item_selection', 'selection_item', 'selection_id', 'selection', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_selection_item_item', 'selection_item', 'item_id', 'shop_item', 'id', 'cascade', 'cascade');

        $auth = Yii::$app->authManager;

        $selection = $auth->createPermission('shop_selection');
        $selection->description = 'Подборки';
        $auth->add($selection);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $selection);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $modules = [
            ['selection', 'Подборки', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $modules);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('shop_selection'));
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $this->delete('module', ['parent_id' => $id, 'name' => 'selection']);
        $this->dropForeignKey('fk_selection_item_selection', 'selection_item');
        $this->dropForeignKey('fk_selection_item_item', 'selection_item');
        $this->dropTable('selection_item');
        $this->dropForeignKey('FK_selection_option_selection', 'selection_option');
        $this->dropForeignKey('FK_selection_option_filter_item', 'selection_option');
        $this->dropForeignKey('FK_selection_option_filter', 'selection_option');
        $this->dropTable('selection_option');
        $this->dropTable('selection');
    }
}
