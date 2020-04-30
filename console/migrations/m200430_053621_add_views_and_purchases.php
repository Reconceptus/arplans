<?php

use modules\shop\models\Item;
use modules\shop\models\Order;
use modules\shop\models\Stat;
use yii\db\Migration;

/**
 * Class m200430_053621_add_views_and_purchases
 */
class m200430_053621_add_views_and_purchases extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('shop_item_stat', [
            'id'        => $this->primaryKey()->unsigned(),
            'views'     => $this->integer()->unsigned()->defaultValue(0),
            'purchases' => $this->integer()->unsigned()->defaultValue(0),
        ]);
        $this->addForeignKey('fk_item_stat_item', 'shop_item_stat', 'id', 'shop_item', 'id');
        $models = Item::find()->all();
        /* @var $models Item[] */
        foreach ($models as $model) {
            $stat = new Stat();
            $stat->id = $model->id;
            $stat->save();
        }

        $noneed = [1, 2, 5, 6, 12, 13, 27, 46];

        $orders = Order::find()->all();
        /*  @var $orders Order[] */
        foreach ($orders as $order) {
            if ($order->price > 100 && !in_array($order->user_id, $noneed, true)) {
                foreach ($order->orderItems as $oi) {
                    $item = $oi->item->stat;
                    ++$item->purchases;
                    $item->save();
                }
            }
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('shop_item_stat');
    }
}
