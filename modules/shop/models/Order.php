<?php

namespace modules\shop\models;

use common\models\PaymentSystem;
use common\models\User;
use yii\helpers\Html;

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
 * @property OrderItem[] $orderItems
 * @property Item[] $items
 * @property OrderService[] $orderServices
 * @property Service[] $services
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 1;

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
            'id'         => 'ID',
            'user_id'    => 'Покупатель',
            'status'     => 'Статус',
            'comment'    => 'Комментарий (виден только админу)',
            'fio'        => 'ФИО',
            'phone'      => 'Телефон',
            'email'      => 'Email',
            'country'    => 'Страна',
            'city'       => 'Город',
            'address'    => 'Адрес',
            'village'    => 'Дополнительная информация',
            'payment_id' => 'Платежная система',
            'price'      => 'Цена',
            'created_at' => 'Дата',
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
    public function getOrderItems()
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
    public function getOrderServices()
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

    /**
     * Создание заказа
     * @param $fio
     * @param User $user
     * @param $email
     * @param $phone
     * @param $country
     * @param $city
     * @param $address
     * @param string $village
     * @return Order|null
     */
    public static function createOrder($fio, User $user, $email, $phone, $country, $city, $address, $village = '')
    {
        $profile = $user->profile;
        $order = new self();
        $order->user_id = $user->id;
        $order->fio = $fio ? Html::encode($fio) : $profile->fio;
        $order->email = $email ? Html::encode($email) : $profile->email;
        $order->phone = $phone ? Html::encode($phone) : $profile->phone;
        $order->country = $country ? Html::encode($country) : $profile->country;
        $order->city = $city ? Html::encode($city) : $profile->city;
        $order->address = $address ? Html::encode($address) : $profile->address;
        $order->village = Html::encode($village);
        $order->status = self::STATUS_NEW;
        $order->created_at = date('Y-m-d H:i:s');
        if ($order->save()) {
            return $order;
        }
        return null;
    }

    /**
     * Добавление товаров к заказу
     * @param array $data
     * @return float|int
     */
    public function addItems(array $data){
        $amount = 0;
        foreach ($data as $item) {
            $itemModel = Item::findActive($item['id']);
            if ($itemModel) {
                $albumPrice = intval(Config::getValue('album_price'));
                $itemPrice = $itemModel->getPrice();
                $price = $itemPrice + $albumPrice * (intval($item['count']) > 0 ? intval($item['count']) - 1 : 0);
                $orderItem = new OrderItem();
                $orderItem->order_id = $this->id;
                $orderItem->item_id = intval($item['id']);
                $orderItem->count = intval($item['count']);
                $orderItem->price = $price;
                if (intval($item['change'])) {
                    $orderItem->comment = 'Требуется изменить материал';
                }
                if ($orderItem->save()) {
                    $amount += $price;
                }
            }
        }
        return $amount;
    }

    /**
     * Добавление услуг к заказу
     * @param array $data
     * @return float|int
     */
    public function addServices(array $data)
    {
        $amount = 0;
        foreach ($data as $serviceId) {
            $service = Service::findOne(intval($serviceId));
            if ($service) {
                $orderService = new OrderService();
                $orderService->order_id = $this->id;
                $orderService->service_id = $service->id;
                $orderService->price = $service->price;
                if ($orderService->save()) {
                    $amount += $service->price;
                }
            }
        }
        return $amount;
    }
}