<?php

use yii\db\Migration;

/**
 * Class m200428_082752_create_promocode
 */
class m200428_082752_create_promocode extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_promocode', [
            'id'               => $this->primaryKey()->unsigned(),
            'code'             => $this->string(100),
            'fixed_discount'   => $this->integer()->unsigned()->defaultValue(0),
            'percent_discount' => $this->float()->unsigned()->defaultValue(0),
            'min_amount'       => $this->integer()->defaultValue(0),
            'number_of_uses'   => $this->integer(),
            'used'             => $this->integer(),
            'text'             => $this->text(),
            'status'           => $this->smallInteger(1),
            'start_date'       => $this->date()->comment('Первый день действия'),
            'end_date'         => $this->date()->comment('Последний день действия')
        ]);
        $this->addColumn('shop_order', 'promocode_id', $this->integer()->unsigned());
        $this->addColumn('shop_order', 'price_after_promocode', $this->float());


        $auth = Yii::$app->authManager;

        $promocode = $auth->createPermission('shop_promocode');
        $promocode->description = 'Промокоды';
        $auth->add($promocode);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $promocode);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $modules = [
            ['promocode', 'Промокоды', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $modules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('shop_promocode'));
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $this->delete('module', ['parent_id' => $id, 'name' => 'promocode']);
        $this->dropColumn('shop_order', 'promocode_id');
        $this->dropColumn('shop_order', 'price_after_promocode');
        $this->dropTable('shop_promocode');
    }
}
