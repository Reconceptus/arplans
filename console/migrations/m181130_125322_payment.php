<?php

use yii\db\Migration;

/**
 * Class m181130_125322_payment
 */
class m181130_125322_payment extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('payment', [
            'id'         => $this->primaryKey()->unsigned(),
            'user_id'    => $this->integer(),
            'order_id'   => $this->integer()->unsigned(),
            'ip'         => $this->string(20),
            'guid'       => $this->string(40),
            'payment_id' => $this->string(40),
            'amount'     => $this->decimal(14, 2),
            'currency'   => $this->string(10),
            'status'     => $this->smallInteger(1)->defaultValue(1),
            'created_at' => $this->dateTime(),
            'updated_at' => $this->dateTime(),
            'payed_at'   => $this->dateTime(),
            'reason'     => $this->string(40)
        ]);

        $this->addForeignKey('FK_payment_order', 'payment', 'order_id', 'shop_order', 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_payment_order', 'payment');
        $this->dropTable('payment');
    }
}
