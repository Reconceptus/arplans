<?php
/**
 * Created by PhpStorm.
 * User: borod
 * Date: 03.09.2018
 * Time: 10:42
 */

namespace modules\shop\frontend\controllers;

use modules\shop\models\Order;
use modules\shop\models\Payment;
use YandexCheckout\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PaymentController extends Controller
{
    /**
     * Вывод корзины
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $orderId = intval(\Yii::$app->request->get('order'));
        $order = Order::findOne(['id' => $orderId]);
        $yaData = \Yii::$app->params['yakassa'];
        $paymentObj = Payment::findOne(['order_id' => $order->id]);
        if($paymentObj) {
            $dateMissed = (new \DateTime())->modify('-1 day')->format('Y-m-d H:i:s');
            if ($paymentObj->created_at < $dateMissed) {
                $paymentObj->status = Payment::STATUS_CANCEL;
                $paymentObj->save();
                unset($paymentObj);
            }
        }
        if (!isset($paymentObj) || !$paymentObj) {
            $paymentObj = Payment::createPayment($order);
            $paymentObj->save();
        }
        $client = new Client();
        $client->setAuth($yaData['shopId'], $yaData['secretKey']);
        $payment = $client->createPayment(
            [
                'amount'       => [
                    'value'    => $paymentObj->amount,
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type'       => 'redirect',
                    'return_url' => \Yii::$app->request->getHostInfo() . '/shop/payment/return?pid=' . $paymentObj->id,
                ],
                'description'  => 'Оплата заказа #' . $paymentObj->order_id . ' в магазине Arplans',
                'capture'      => true
            ],
            $paymentObj->guid
        );
        if ($payment->confirmation) {
            $paymentObj->payment_id = $payment->id;
            $paymentObj->save();
            return $this->redirect($payment->confirmation->confirmationUrl);
        }
    }

    public function actionReturn()
    {
        $id = \Yii::$app->request->get('pid');
        $paymentObj = Payment::find()->where(['id' => $id])->one();
        /* @var $paymentObj Payment */
        if ($paymentObj) {
            if ($result = $paymentObj->getInfo()) {
                return $this->render('return', ['model' => $result]);
            }
        } else {
            throw new NotFoundHttpException();
        }
    }
}