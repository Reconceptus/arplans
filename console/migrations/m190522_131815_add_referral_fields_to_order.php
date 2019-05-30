<?php

use yii\db\Migration;

/**
 * Class m190522_131815_add_referral_fields_to_order
 */
class m190522_131815_add_referral_fields_to_order extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('shop_order', 'referrer_id', $this->integer());
        $this->addColumn('shop_order', 'referrer_bonus', $this->decimal(14, 2));
        $this->addColumn('user', 'bonus_total', $this->decimal(14, 2));
        $this->addColumn('user', 'bonus_payed', $this->decimal(14, 2));
        $this->addForeignKey('fk_order_referrer', 'shop_order', 'referrer_id', 'user', 'id');
        $this->createTable('ref_request', [
            'id'          => $this->primaryKey()->unsigned(),
            'referrer_id' => $this->integer(),
            'amount'      => $this->string(),
            'status'      => $this->smallInteger(1)->defaultValue(0),
            'info'        => $this->string(),
            'comment'     => $this->string(),
            'created_at'  => $this->dateTime(),
            'updated_at'  => $this->dateTime(),
        ]);

        $auth = Yii::$app->authManager;

        // создать разрешения
        $ref = $auth->createPermission('shop_referrer');
        $ref->description = 'Доступ к запросам рефереров';
        $auth->add($ref);


        $admin = $auth->getRole('admin');
        $auth->addChild($admin, $ref);

        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $shopModules = [
            ['referrer', 'Рефереры', $id],
        ];
        $this->batchInsert('module', ['name', 'title', 'parent_id'], $shopModules);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $id = $this->db->createCommand("SELECT id FROM module WHERE name='shop'")->queryScalar();
        $this->delete('module', ['parent_id' => $id, 'name' => 'referrer']);
        $auth = Yii::$app->authManager;
        $auth->remove($auth->getPermission('shop_referrer'));

        $this->dropForeignKey('fk_order_referrer', 'shop_order');
        $this->dropColumn('user', 'bonus_total');
        $this->dropColumn('user', 'bonus_payed');
        $this->dropColumn('shop_order', 'referrer_bonus');
        $this->dropColumn('shop_order', 'referrer_id');
        $this->dropTable('ref_request');
    }
}
