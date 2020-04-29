<?php

namespace modules\shop\models;

use common\models\User;
use YandexCheckout\Client;
use Yii;

/**
 * This is the model class for table "payment".
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 * @property string $ip
 * @property string $guid
 * @property string $payment_id
 * @property string $amount
 * @property string $payed
 * @property string $currency
 * @property string $reason
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string $payed_at
 *
 * @property Order $order
 */
class Payment extends \yii\db\ActiveRecord
{

    const STATUS_NEW = 1;
    const STATUS_CANCEL = 2;
    const STATUS_COMPLETE = 3;


    const PAYMENT_ERRORS = [
        '3d_secure_failed'              => 'Не пройдена аутентификация по 3-D Secure.',
        'call_issuer'                   => 'Оплата данным платежным средством отклонена по неизвестным причинам.',
        'card_expired'                  => 'Истек срок действия банковской карты.',
        'country_forbidden'             => 'Нельзя заплатить банковской картой, выпущенной в этой стране.',
        'fraud_suspected'               => 'Платеж заблокирован.',
        'general_decline'               => 'Причина не детализирована',
        'insufficient_funds'            => 'Не хватает денег для оплаты.',
        'identification_required'       => 'Превышены ограничения на платежи для кошелька в Яндекс.Деньгах.',
        'invalid_card_number'           => 'Неправильно указан номер карты.',
        'invalid_csc'                   => 'Неправильно указан код CVV2 (CVC2, CID)',
        'issuer_unavailable'            => 'Организация, выпустившая платежное средство, недоступна',
        'payment_method_limit_exceeded' => 'Исчерпан лимит платежей для данного платежного средства',
        'payment_method_restricted'     => 'Запрещены операции данным платежным средством.',
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_id', 'user_id', 'status'], 'integer'],
            [['amount', 'payed'], 'number'],
            [['created_at', 'updated_at', 'payed_at'], 'safe'],
            [['ip'], 'string', 'max' => 20],
            [['guid', 'payment_id', 'reason'], 'string', 'max' => 40],
            [['currency'], 'string', 'max' => 10],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
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
            'order_id'   => 'Заказ',
            'user_id'    => 'Пользователь',
            'ip'         => 'IP',
            'guid'       => 'Guid',
            'amount'     => 'Сумма',
            'currency'   => 'Валюта',
            'status'     => 'Статус',
            'created_at' => 'Создан',
            'updated_at' => 'Изменен',
            'payed_at'   => 'Оплачен',
            'reason'     => 'Причина',
            'payed'      => 'Уплачено',
        ];
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->created_at = date('Y-m-d H:i:s', time());
        }
        $this->updated_at = date('Y-m-d H:i:s', time());
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @param Order $order
     * @return Payment
     */
    public static function createPayment(Order $order)
    {
        $payment = new Payment();
        $payment->guid = uniqid('', true);
        $payment->order_id = $order->id;
        $payment->amount = $order->price_after_promocode??$order->price;
        $payment->currency = 'RUB';
        $payment->user_id = Yii::$app->user->id;
        $payment->ip = Yii::$app->request->userIP;
        return $payment;
    }

    /**
     * @return $this|null
     * @throws \YandexCheckout\Common\Exceptions\ApiException
     * @throws \YandexCheckout\Common\Exceptions\BadApiRequestException
     * @throws \YandexCheckout\Common\Exceptions\ForbiddenException
     * @throws \YandexCheckout\Common\Exceptions\InternalServerError
     * @throws \YandexCheckout\Common\Exceptions\NotFoundException
     * @throws \YandexCheckout\Common\Exceptions\ResponseProcessingException
     * @throws \YandexCheckout\Common\Exceptions\TooManyRequestsException
     * @throws \YandexCheckout\Common\Exceptions\UnauthorizedException
     */
    public function getInfo()
    {
        if ($this->status === self::STATUS_NEW) {
            $yaData = \Yii::$app->params['yakassa'];
            $client = new Client();
            $client->setAuth($yaData['shopId'], $yaData['secretKey']);
            $payment = $client->getPaymentInfo($this->payment_id);
            if ($payment) {
                $order = $this->order;
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    if ($payment->status == 'succeeded' && $payment->paid == true) {
                        if (floatval($payment->amount->value) == $order->price) {
                            $this->status = self::STATUS_COMPLETE;
                            $this->payed_at = date('Y-m-d H:i:s', time());
                            $order->status = Order::STATUS_PAYED;
                            $order->save();
                        }
                        $this->payed = $payment->amount->value;
                    } elseif ($payment->status == 'canceled') {
                        $this->reason = $payment->cancellationDetails->reason;
                        $this->status = self::STATUS_CANCEL;
                    }
                    $this->save();
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                    return null;
                }
            }
        }
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReasonName()
    {
        return self::PAYMENT_ERRORS[$this->reason];
    }
}
