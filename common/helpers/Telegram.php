<?php


namespace common\helpers;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\httpclient\Client;

class Telegram
{
    public static function send($text, $email = null, $params = [])
    {
        if (!$email) {
            $email = Yii::$app->params['adminEmail'];
        }
        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('POST')
            ->setFormat(Client::FORMAT_JSON)
            ->setUrl(Yii::$app->params['telegramUrl'])
            ->setData([
                'email' => $email, 'text' => $text, 'site' => ArrayHelper::getValue(Yii::$app->params, 'telegramBearer') ?? 'arplans.ru'
            ])
            ->send();
        if (!$response->isOk) {
            Yii::info('Проблема телеграма:'.Json::encode($response));
        }
    }
}