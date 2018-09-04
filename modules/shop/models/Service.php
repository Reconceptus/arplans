<?php

namespace modules\shop\models;

/**
 * This is the model class for table "shop_service".
 *
 * @property int $id
 * @property string $name
 * @property string $slug
 * @property string $description
 * @property string $price
 * @property int $in_cart
 *
 * @property OrderService[] $shopOrderServices
 * @property Order[] $orders
 */
class Service extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_service';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['price'], 'number'],
            [['in_cart'], 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'slug' => 'Slug',
            'description' => 'Description',
            'price' => 'Price',
            'in_cart' => 'In Cart',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['service_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['id' => 'order_id'])->viaTable('shop_order_service', ['service_id' => 'id']);
    }
}
