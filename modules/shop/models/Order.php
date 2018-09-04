<?php

namespace modules\shop\models;

use common\models\PaymentSystem;
use common\models\User;

/**
 * This is the model class for table "shop_order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $status
 * @property string $comment
 * @property string $fio
 * @property string $phone
 * @property string $email
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $village
 * @property int $payment_id
 * @property string $price Цена только товаров, без допуслуг
 * @property string $created_at
 * @property string $updated_at
 *
 * @property PaymentSystem $payment
 * @property User $user
 * @property OrderItem[] $shopOrderItems
 * @property Item[] $items
 * @property OrderService[] $shopOrderServices
 * @property Service[] $services
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'shop_order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'status', 'payment_id'], 'integer'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['comment', 'village'], 'string', 'max' => 800],
            [['fio', 'country', 'city', 'address'], 'string', 'max' => 255],
            [['phone', 'email'], 'string', 'max' => 50],
            [['payment_id'], 'exist', 'skipOnError' => true, 'targetClass' => PaymentSystem::className(), 'targetAttribute' => ['payment_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'status' => 'Status',
            'comment' => 'Comment',
            'fio' => 'Fio',
            'phone' => 'Phone',
            'email' => 'Email',
            'country' => 'Country',
            'city' => 'City',
            'address' => 'Address',
            'village' => 'Village',
            'payment_id' => 'Payment ID',
            'price' => 'Price',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayment()
    {
        return $this->hasOne(PaymentSystem::className(), ['id' => 'payment_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Item::className(), ['id' => 'item_id'])->viaTable('shop_order_item', ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShopOrderServices()
    {
        return $this->hasMany(OrderService::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])->viaTable('shop_order_service', ['order_id' => 'id']);
    }
}
