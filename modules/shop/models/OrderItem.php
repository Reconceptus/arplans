<?php

namespace modules\shop\models;

use yii\db\ActiveQuery;

/**
 * This is the model class for table "shop_order_item".
 *
 * @property int $id
 * @property int $order_id
 * @property int $item_id
 * @property int $count
 * @property int $change_material
 * @property string $price
 * @property string $price_after_promocode
 * @property string $comment
 *
 * @property Item $item
 * @property Order $order
 */
class OrderItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_order_item';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'item_id', 'count'], 'required'],
            [['order_id', 'item_id', 'count'], 'integer'],
            [['price', 'price_after_promocode'], 'number'],
            [['change_material'], 'boolean'],
            [['comment'], 'string', 'max' => 800],
            [['order_id', 'item_id'], 'unique', 'targetAttribute' => ['order_id', 'item_id']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => Item::className(), 'targetAttribute' => ['item_id' => 'id']],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'                    => 'ID',
            'order_id'              => 'Номер заказа',
            'item_id'               => 'ID товара',
            'count'                 => 'Количество',
            'price'                 => 'Цена',
            'price_after_promocode' => 'Цена после промокода',
            'comment'               => 'Комментарий',
            'change_material'       => 'Изменить материал',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getItem()
    {
        return $this->hasOne(Item::className(), ['id' => 'item_id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
