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
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PaymentController extends Controller
{
    public function beforeAction($action)
    {
        \Yii::$app->request->enableCsrfValidation = false;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * Вывод корзины
     * @return string
     * @throws \yii\base\Exception
     */
    public function actionIndex()
    {
        $orderId = intval(\Yii::$app->request->get('order'));
        $order = Order::findOne(['id' => $orderId]);
        if (!$order) {
            throw new NotFoundHttpException();
        }
        $yaData = \Yii::$app->params['yakassa'];

        $paymentObj = Payment::createPayment($order);
        $paymentObj->save();
        $itemsData = [];
        foreach ($order->orderItems as $item) {
            $itemsData[] = [
                'description' => $item->item->name,
                'quantity' => $item->count,
                'amount' => ['currency' => 'RUB', 'value' => $item->price],
                'vat_code' => 1,
            ];
        }
        $client = new Client();
        $client->setAuth($yaData['shopId'], $yaData['secretKey']);
        $payment = $client->createPayment(
            [
                'amount' => [
                    'value' => $paymentObj->amount,
                    'currency' => 'RUB',
                ],
                'confirmation' => [
                    'type' => 'redirect',
                    'return_url' => \Yii::$app->request->getHostInfo() . '/shop/payment/return?pid=' . $paymentObj->id,
                ],
                'receipt' => [
                    'email' => $order->email,
                    'items' => $itemsData,
                ],
                'description' => 'Оплата заказа #' . $paymentObj->order_id . ' в магазине Arplans',
                'capture' => true
            ],
            $paymentObj->guid
        );
        if ($payment->confirmation) {
            $paymentObj->payment_id = $payment->id;
            $paymentObj->save();
            return $this->redirect($payment->confirmation->confirmationUrl);
        } else {
            $paymentObj->status = Payment::STATUS_CANCEL;
            $paymentObj->save();
            return $this->refresh();
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

    public function actionConfirm()
    {
        $post = \Yii::$app->request->post();
        $object = $post['object'];
        if (!empty($object) && is_array($object)) {
            $payment = Payment::find()->where(['payment_id' => $object['id']])->andWhere(['status' => Payment::STATUS_NEW])->one();
            /* @var $payment Payment */
            if ($payment) {
                $order = $payment->order;
                $connection = Yii::$app->db;
                $transaction = $connection->beginTransaction();
                try {
                    if ($object['status'] === 'succeeded' && $object['paid'] == 1) {
                        if (floatval($object['amount']['value']) == $order->price) {
                            $payment->status = Payment::STATUS_COMPLETE;
                            $payment->payed_at = date('Y-m-d H:i:s', time());
                            $order->status = Order::STATUS_PAYED;
                            $order->save();
                        }
                        $payment->payed = $object['amount']['value'];
                    }
                    $payment->save();
                    $transaction->commit();
                } catch (\Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
    }

}